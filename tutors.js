// Run the tutor page helpers after the page has loaded.
document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('q');
    var tutorCards = document.querySelectorAll('.tutor-card');
    var programFilter = document.getElementById('program-filter');
    var tutorCount = document.getElementById('tutor-count');
    var clientEmptyState = document.getElementById('client-empty-state');

    var tutorForm = document.getElementById('register-tutor-form');
    var submitButton = document.getElementById('register-submit');
    var nameInput = document.getElementById('name');
    var programInput = document.getElementById('program');
    var subjectsInput = document.getElementById('subjects');
    var emailInput = document.getElementById('email');
    var subjectsCount = document.getElementById('subjects-count');

    // Add real filter choices based on the tutors already shown on the page.
    function loadFilterOptions() {
        if (!programFilter) {
            return;
        }

        var savedValues = [];
        var i;

        for (i = 0; i < tutorCards.length; i += 1) {
            var card = tutorCards[i];
            var optionValues = [
                'program:' + card.getAttribute('data-program'),
                'subject:' + card.getAttribute('data-subjects'),
                'email:' + card.getAttribute('data-email')
            ];
            var j;

            for (j = 0; j < optionValues.length; j += 1) {
                if (savedValues.indexOf(optionValues[j]) === -1) {
                    savedValues.push(optionValues[j]);
                }
            }
        }

        savedValues.sort();

        for (i = 0; i < savedValues.length; i += 1) {
            var parts = savedValues[i].split(':');
            var option = document.createElement('option');
            var labelText = parts[0].charAt(0).toUpperCase() + parts[0].slice(1) + ': ' + parts.slice(1).join(':');

            option.value = savedValues[i].toLowerCase();
            option.textContent = labelText;
            programFilter.appendChild(option);
        }
    }

    // Filter the tutor cards that are already on the page as the user types.
    function filterTutorCards() {
        if (!searchInput) {
            return;
        }

        // Read the current search text once before checking the cards.
        var searchText = searchInput.value.trim().toLowerCase();
        var selectedFilter = 'all';
        var visibleCards = 0;
        var firstMatchingCardFound = false;
        var i;

        if (programFilter) {
            selectedFilter = programFilter.value;
        }

        for (i = 0; i < tutorCards.length; i += 1) {
            var card = tutorCards[i];
            var nameText = card.getAttribute('data-name').toLowerCase();
            var programText = card.getAttribute('data-program').toLowerCase();
            var subjectsText = card.getAttribute('data-subjects').toLowerCase();
            var emailText = card.getAttribute('data-email').toLowerCase();
            var allText = card.textContent.toLowerCase();
            var searchMatches = searchText === '' || allText.indexOf(searchText) !== -1;
            var shouldShow = false;

            if (selectedFilter === 'latest') {
                shouldShow = searchMatches;

                if (shouldShow && firstMatchingCardFound) {
                    shouldShow = false;
                }
            } else if (selectedFilter.indexOf('program:') === 0) {
                shouldShow = searchMatches && programText === selectedFilter.replace('program:', '');
            } else if (selectedFilter.indexOf('subject:') === 0) {
                shouldShow = searchMatches && subjectsText === selectedFilter.replace('subject:', '');
            } else if (selectedFilter.indexOf('email:') === 0) {
                shouldShow = searchMatches && emailText === selectedFilter.replace('email:', '');
            } else {
                shouldShow = searchMatches;
            }

            // Show matching cards and hide the rest.
            card.style.display = shouldShow ? 'inline-block' : 'none';

            if (shouldShow) {
                // Count how many cards are still visible.
                visibleCards += 1;

                if (selectedFilter === 'latest') {
                    firstMatchingCardFound = true;
                }
            }
        }

        if (tutorCount) {
            tutorCount.textContent = 'Showing ' + visibleCards + ' tutor' + (visibleCards === 1 ? '' : 's') + '.';
        }

        if (clientEmptyState) {
            if (visibleCards === 0) {
                // Show a message if none of the current cards match.
                clientEmptyState.className = 'empty-state';
            } else {
                clientEmptyState.className = 'empty-state hidden';
            }
        }
    }

    // Show a short message under each field so the user knows what still needs fixing.
    function setFieldFeedback(input, feedbackId, message) {
        var feedback = document.getElementById(feedbackId);

        if (!feedback || !input) {
            return;
        }

        // Write the message under the field.
        feedback.textContent = message;

        if (message !== '') {
            input.className = 'input-error';
        } else {
            input.className = '';
        }
    }

    // Keep the email check simple and readable for a class project.
    function isEmailValid(email) {
        var atPosition = email.indexOf('@');
        var dotPosition = email.lastIndexOf('.');

        return (
            atPosition > 0 &&
            dotPosition > atPosition + 1 &&
            dotPosition < email.length - 1
        );
    }

    // Keep the checks simple and readable for each input field.
    function validateTutorForm() {
        if (!tutorForm || !submitButton) {
            return;
        }

        // Trim the values so spaces do not count as real input.
        var nameValue = nameInput.value.trim();
        var programValue = programInput.value.trim();
        var subjectsValue = subjectsInput.value.trim();
        var emailValue = emailInput.value.trim();

        setFieldFeedback(nameInput, 'name-feedback', nameValue === '' ? 'Please enter your name.' : '');
        setFieldFeedback(programInput, 'program-feedback', programValue === '' ? 'Please enter your program.' : '');
        setFieldFeedback(subjectsInput, 'subjects-feedback', subjectsValue === '' ? 'Please list at least one subject.' : '');

        if (emailValue === '') {
            setFieldFeedback(emailInput, 'email-feedback', 'Please enter your email address.');
        } else if (!isEmailValid(emailValue)) {
            // Give a different message if an email was typed but looks wrong.
            setFieldFeedback(emailInput, 'email-feedback', 'Please enter a valid email address.');
        } else {
            setFieldFeedback(emailInput, 'email-feedback', '');
        }

        // Only allow the form to submit when every field looks valid.
        submitButton.disabled = !(
            nameValue !== '' &&
            programValue !== '' &&
            subjectsValue !== '' &&
            isEmailValid(emailValue)
        );
    }

    // Show a small counter so the user knows how much they typed in the subjects field.
    function updateSubjectsCount() {
        if (!subjectsInput || !subjectsCount) {
            return;
        }

        // Count the characters the user typed into the subjects box.
        var totalCharacters = subjectsInput.value.trim().length;
        subjectsCount.textContent = totalCharacters + ' character' + (totalCharacters === 1 ? '' : 's') + ' typed.';
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterTutorCards);
    }

    if (programFilter) {
        programFilter.addEventListener('change', filterTutorCards);
    }

    loadFilterOptions();
    filterTutorCards();

    if (tutorForm) {
        // Recheck the whole form each time the user updates a field.
        nameInput.addEventListener('input', validateTutorForm);
        programInput.addEventListener('input', validateTutorForm);
        subjectsInput.addEventListener('input', validateTutorForm);
        emailInput.addEventListener('input', validateTutorForm);

        subjectsInput.addEventListener('input', updateSubjectsCount);

        tutorForm.addEventListener('submit', function (event) {
            validateTutorForm();

            if (submitButton.disabled) {
                // Stop the form if the field checks still fail.
                event.preventDefault();
            }
        });

        updateSubjectsCount();
        validateTutorForm();
    }
});
