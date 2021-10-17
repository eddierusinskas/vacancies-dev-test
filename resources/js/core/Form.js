import Errors from './Errors';

class Form {
    constructor(formData) {
        this.data = {};
        if (typeof formData !== 'undefined') {
            if (Array.isArray(formData)) formData.forEach((key) => this.data[key] = null)
            else this.data = formData;
        }
        this.original_data = Object.assign({}, this.data);
        this.errors = new Errors();

    }

    /**
     * Reset the form fields.
     */
    reset() {
        for (let field in this.data) {
            this.data[field] = '';
        }

        this.errors.clear();
    }

    /**
     * Fill form data with modal
     *
     * @param model
     */
    fill(model) {
        for (let key in this.data) {
            this.data[key] = model[key] ? model[key] : null;
        }
    }


    /**
     * Send a POST request to the given URL.
     * .
     * @param {string} url
     */
    post(url) {
        return this.submit('post', url);
    }


    /**
     * Send a PUT request to the given URL.
     * .
     * @param {string} url
     */
    put(url) {
        return this.submit('put', url);
    }


    /**
     * Send a PATCH request to the given URL.
     * .
     * @param {string} url
     */
    patch(url) {
        return this.submit('patch', url);
    }


    /**
     * Send a DELETE request to the given URL.
     * .
     * @param {string} url
     */
    delete(url) {
        return this.submit('delete', url);
    }


    /**
     * Submit the form.
     *
     * @param {string} requestType
     * @param {string} url
     */
    submit(requestType, url) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data)
                .then((response) => {
                    resolve(response);
                })
                .catch((error) => {
                    this.onFail(error.response.data.errors);

                    reject(error.response);
                });
        });
    }

    /**
     * Handle a failed form submission.
     *
     * @param {object} response
     */
    onFail(response) {
        this.errors.record(response);
    }

    /**
     * Retrieve data as form dta
     *
     * @returns {FormData}
     */
    toFormData() {
        let formData = new FormData();

        for (let field in this.data) {
            formData.append(field, this.data[field]);
        }

        return formData;
    }
}

export default Form
