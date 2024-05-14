/** JS Code to represent Modal that asks for Token File and Validates It */

/** Functionalities
 * Create new instance inside given container
 * Embed the button and modal inside the container with jQuery
 * Develop the file input and submit button inside modal
 * Handle AJAX request to ask for tokens from the backend
 */

class TokenModal
{
    constructor(container_id, modal_id)
    {
        this.container = $(`#${container_id}`);
        this.modal_id = modal_id;
        
        this.modal_markup = `
        <div id="${this.modal_id}" class="modal fade opaque-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Token File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="mt-4 modal-body">
                        <form id="token-modal-form">
                            <div class="mb-4 custom-file">
                                <input type="file" class="custom-file-input" id="token-file-input">
                                <label class="custom-file-label" for="token-file-input">Choose file</label>
                                <div class="valid-tooltip token-file-input">That text file looks well</div>
                                <div class="invalid-tooltip token-file-input">You must submit a text file</div>
                            </div>
                            <div class="d-none">
                                <textarea id="token-file-textarea"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="token-file-btn-close" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button id="token-file-btn-submit" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>`;
    }

    append_to_container()
    {
        this.container.append(this.modal_markup);
    }

    remove_from_DOM()
    {
        $(`#${this.modal_id}`).remove();
    }

    show_modal()
    {
        $(`#${this.modal_id}`).modal("show");
    }

    handle_submit_to_backend(user_id, rememberMe, error_msg_container_id)
    {
        const self = this;

        const tokenFileForm = $("#token-modal-form");
        const tokenFileInput = $("#token-file-input");
        const tokenFileBtnSubmit = $("#token-file-btn-submit");
        const tokenFileHiddenTextArea = $("#token-file-textarea");
        const tokenFileBtnClose = $("#token-file-btn-close");
        
        tokenFileInput.on(
            {change: function(e) {
                // Place file name where it belongs
                const fileName = $(this).val().split("\\").pop();
                $("label[for='token-file-input']").addClass("selected").html(fileName);

                // If a text file was placed. Add the valid class with a feedback message
                const givenFile = e.target.files[0];

                if (givenFile.type == "text/plain")
                {
                    tokenFileInput.addClass("is-valid");
                    tokenFileInput.removeClass("is-invalid");

                    // Encode the file in base-64 and add the value to the hidden textarea
                    encodeTextFileToBase64(givenFile)
                        .then(function(content) {
                            tokenFileHiddenTextArea.text(content);
                        })
                        .catch(function(error) {
                            displayFormErrorAlert("token-modal-form", error);
                        });
                }

                else
                {
                    tokenFileInput.removeClass("is-valid");
                    tokenFileInput.addClass("is-invalid");
                }

            },
            focus: () => formControlFocusValidate("token-file-input"),
            blur: () => formControlBlurValidate("token-file-input")

            }
        );

        tokenFileBtnSubmit.on("click", function () {
            tokenFileForm.trigger("submit");
        });

        tokenFileForm.on("submit", function(e) {
            // Grab the file
            // Prevent default form submission
            e.preventDefault();

            // Check that the input has the class "is-valid"
            if (!tokenFileInput.hasClass("is-valid"))
            {
                displayFormErrorAlert("token-modal-form", "You need to submit a text file");
            }

            // Otherwise, send AJAX to the backend
            else
            {
                // Grab the content written on the textarea
                const encoded_content = tokenFileHiddenTextArea.text();

                // Prepare data to be sent to the backend
                const data = JSON.stringify({
                    user_id,
                    encoded_content
                });
                
                // Form the JSON
                $.ajax({
                    url: `${websiteURL}/form-handlers/tokens.php`,
                    method: "POST",
                    contentType: "application/json",
                    data,
                    beforeSend: function() {
                        // Disable Submit Btn
                        tokenFileBtnSubmit.html(loadingSpinner());
                        tokenFileBtnSubmit.prop("disabled", true);
                    },
                    success: function() {
                        // Send traditional request to log in
                        // Grab the user-id input and place the user-id there
                        $("input[name='user-id']").val(user_id);

                        // Place remember me for cookie generation if appropriate
                        if (rememberMe)
                        {
                            $("input[name='rememberMe']").prop("checked", true);
                        }

                        // Submit the form for traditional session start
                        $("input[name='token-submit']").trigger("click");
                    },
                    error: function(xhr) {
                        displayFormErrorAlert(`${error_msg_container_id}`, xhr.responseJSON["error"]);
                    },
                    complete: function() {
                        // Enable Submit Btn
                        tokenFileBtnSubmit.html("Submit");
                        tokenFileBtnSubmit.prop("disabled", false);
                        // Close Modal
                        tokenFileBtnClose.trigger("click");
                        // Remove Modal From DOM
                        self.remove_from_DOM();
                    }
                });
            }

        });
    }
}