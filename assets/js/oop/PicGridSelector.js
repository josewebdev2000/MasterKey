/** JS Code to represent a Div that will contain a Grid of Selectable Images 
 * Out of these, one image will be selected and its URL will be uploaded to the backend
 */

/** Functionalities
 * Control hover effect to let user what image is meant to be selected
 * Place a border and increase brightness on selected image
 * Provide URL of the currently selected image for later on back-end submission
 */

class PicGridSelector
{
    constructor(pics_container_id, input_url_id, button_submit_id)
    {
        const self = this;
        // Generate essential attributes
        self.pics_container = $(`#${pics_container_id}`);
        self.input_url = $(`#${input_url_id}`);
        self.button_submit = $(`#${button_submit_id}`);

        // Grab all images and have them stored in an array
        self.images = this.pics_container.find("img.avatar").toArray();
        
        // Loop for each image, associate to each a mouseenter, mouseleave, click event, and doubleclick events
        // Mouseenter -> Ready to select a picture, border-radius primary border-width 3rem
        // Mouseleave -> Abandon ready to select
        // Click -> Border-radius success border-width 5rem or remove

        // JS Objects that contain
        self.hoverStyles = {
            borderColor: convertHexToRGB("#007bff"),
            borderWidth: "5px",
            borderType: "solid",
            borderRadius: "100%",
            cursor: "pointer"
        };

        self.clickedStyles = {
            borderColor: convertHexToRGB("#28a745"),
            borderWidth: "10px",
            borderType: "solid",
            borderRadius: "100%",
            cursor: "pointer"
        };

        // Code to select a picture
        self.selectPicture(self);
    }

    selectPicture(self)
    {
        // Code Required to Select a Picture
        for (let image of self.images)
            {
                const jQueryImg = $(image);
    
    
                jQueryImg.on({
                    "mouseenter": function() {
                        if (jQueryImg.css("border-color") != self.hoverStyles.borderColor && jQueryImg.css("border-color") != self.clickedStyles.borderColor)
                        {
                            jQueryImg.css({
                                "border": `${self.hoverStyles.borderWidth} ${self.hoverStyles.borderType} ${self.hoverStyles.borderColor}`, 
                                "border-radius": self.hoverStyles.borderRadius,
                                "cursor": self.hoverStyles.cursor
                            });
                        }
                    },
                    "mouseleave": function() {
                        if (jQueryImg.css("border-color") == self.hoverStyles.borderColor)
                        {
                            jQueryImg.css({
                                "border": "none",
                                "cursor": "default"
                            });
                        }
                    },
                    "click": function()
                    {
                        if (jQueryImg.css("border-color") != self.clickedStyles.borderColor)
                        {
                            // In case the user did not deselect another element, do it for all other elements
                            $(".avatar").css({
                                "border": "none",
                                "cursor": "default"
                            });
    
                            jQueryImg.css({
                                "border": `${self.clickedStyles.borderWidth} ${self.clickedStyles.borderType} ${self.clickedStyles.borderColor}`,
                                "border-radius": self.clickedStyles.borderRadius,
                                "cursor": self.clickedStyles.cursor
                            });
                            // Set the value of the hidden input URL to the current source of the selected image
                            self.input_url.val(""); 
                            self.input_url.val(jQueryImg.attr("src")); 
                        }
    
                        else
                        {
                            jQueryImg.css({
                                "border": "none",
                                "cursor": "default"
                            });
                            
                            // Set the value of the hidden input URL
                            self.input_url.val(""); 
                        }
                    } 
                });
            }
    }

    sendPicUrlToBackend(
        self, 
        backedURL, 
        noSendCallback,
        beforeSendCallback, 
        successCallback, 
        errorCallback,
        completeCallback
    )
    {
        /** When the Submit Button is clicked, send the URL to the backend */
        self.button_submit.on("click", function(e) {
            e.preventDefault();

            var doAjax = true;

            if (self.input_url.val().length < 1)
            {
                doAjax = false;
                // Do not start AJAX request
                noSendCallback();
            }

            // Prepare data to be sent
            const data = {
                pic_url: self.input_url.val()
            };

            if (doAjax)
            {
                $.ajax({
                    url: backedURL,
                    method: "POST",
                    contentType: "application/json",
                    data,
                    beforeSend: beforeSendCallback,
                    success: successCallback,
                    error: errorCallback,
                    complete: completeCallback
                });
            }
        });
    }
}