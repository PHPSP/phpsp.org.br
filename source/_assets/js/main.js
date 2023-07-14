import Vue from "vue";
import copyTextToClipboard from "./clipboard";
import MeetupEvents from "./components/meetup-events"
import ScrollSpy from "./scrollspy";

const app = new Vue({
    el: "#app",
    components: { MeetupEvents }
});

window.addEventListener('load', function () {
    new ScrollSpy(
        document.getElementById('post-contents'),
        document.getElementById('toc'),
        document.getElementById('navbar'),
    );
});
