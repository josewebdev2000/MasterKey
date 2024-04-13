/** Add Custom Responsiveness to Bootstrap 4 Button Groups */
class BtnGroupResponsive
{
    constructor(btnGroupSelector, widthBreakpoint)
    {
        this.btnGroup = $(btnGroupSelector);
        this.widthBreakpoint = widthBreakpoint;

        // Call change orientation as soon as it is generated
        this.change_orientation_on_width();

        // Append an event listener of window element to this button
        $(window).on("resize", this.change_orientation_on_width.bind(this));
    }

    change_orientation_on_width()
    {
        /** Change the orientation of a button group according to a width breakpoint */
        if ($(window).width() < this.widthBreakpoint)
        {
            this.btnGroup.removeClass("btn-group").addClass("btn-group-vertical");
        }

        else
        {
            this.btnGroup.removeClass("btn-group-vertical").addClass("btn-group");
        }
    }
}