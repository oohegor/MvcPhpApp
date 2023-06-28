document.getElementById('storePostForm').addEventListener('submit', sendForm);

validateFormInputs = (inputs) => {
	if (inputs.postText.value.replace(/^\s+|\s+$/g,'').length === 0) {
		alert('The post text must be filled');
		return false;
	}
	return true;
}

processResponse = (response) => {
	location.reload();
}

async function sendForm(event) {
	event.preventDefault();

    const form = event.currentTarget;
    const url = form.action;

	if (!validateFormInputs(form)) {
		return false;
	}

    try {
        const formData = new FormData(form);
		const xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.addEventListener('readystatechange', () => {
			if(xhr.readyState === 4) {
				processResponse(xhr.response);
			}
		});

		const csrfMetaTag = document.querySelector('input[name="csrfToken"]');
		if(csrfMetaTag) {
			formData.append('csrfToken', csrfMetaTag.getAttribute('value'));
		}

		xhr.send(formData);
	} catch (error) {
        console.error(error);
    }
}