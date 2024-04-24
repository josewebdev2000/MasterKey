/** JS Code to represent Modal that asks for Token File and Validates It */

/** Functionalities
 * Create new instance inside given container
 * Embed the button and modal inside the container with jQuery
 * Develop the file input and submit button inside modal
 * Handle AJAX request to ask for tokens from the backend
 */

class TokenModal
{
    constructor(container_id, btn_modal_id, modal_id)
    {
        this.container = $(container_id);
        this.btn_modal_id = btn_modal_id;
        this.modal_id = modal_id;
    }

    append_to_container()
    {

    }
}