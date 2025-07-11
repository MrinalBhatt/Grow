var builderCommon; // you can use functions of this js using this variable in another js
jQuery(function ($) {
    builderCommon = {

        init: function () {
            builderCommon.test();
            $(".someClass").on("click", this.someClickEvent);
        },
        test: function () {
            console.log("hi i am test function");
        },
        someClickEvent: function () {
            console.log(jsMsg.siteurl);
            console.log(jsMsg.ajaxurl);
            console.log("hi i am some click event");
        }
    }
    builderCommon.init();
});
