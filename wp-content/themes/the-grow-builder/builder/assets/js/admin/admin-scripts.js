jQuery(function ($) {
    var builderAdminscript = {

        init: function () {
            builderAdminscript.test();
            $(".someClass").on("click", this.someClickEvent);
        },
        test: function () {
            console.log("hi i am test function");
        },
        someClickEvent: function () {
            console.log("hi i am some click event");
        }

    }
    builderAdminscript.init();

});