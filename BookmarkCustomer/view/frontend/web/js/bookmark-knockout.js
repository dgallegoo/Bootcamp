define([
    'uiComponent',
    'ko',
    'underscore',
    'mage/storage',
    'mage/url',
    'jquery'
], function(
    Component,
    ko,
    _,
    storage,
    url,
    $
) {
    'use strict';
    return Component.extend({
        defaults: {
            bookmarkId: 0,
            actualPage: ""
        },
        initialize() {
            this._super();
            console.log('The component BOOKMARK has been loaded')
            console.log(this.bookmarkId)
            this.actualPage = window.location.href;
            this.loadFlag();
        },
        updateBookmark(){
            if(this.bookmarkId === 0) {
                //ADD
                this.addBookmark();
            } else {
                //DELETE
                this.deleteBookmark();
            }
        },
        loadFlag: function () {
            storage
                .get(`${BASE_URL}rest/V1/bookmarks/page/${encodeURIComponent(this.actualPage)}`)
                .done(response => {
                    if (response) {
                        this.bookmarkId = response;
                        this.changeFlagColor();
                    }
                })
                .fail(err => {
                    console.log('Error: ', err);
                });
        },
        changeFlagColor: function () {
            let flag = $('#bookmark-flag');
            if (flag[0].classList.contains('flag-sky')) {
                flag.removeClass('flag-sky');
                flag.addClass('flag');
            } else {
                flag.removeClass('flag');
                flag.addClass('flag-sky');
            }
        },
        addBookmark: function () {
            let bookmark = {
                page_title: document.title,
                url_page: this.actualPage,
            };
            storage
                .post(
                    `${BASE_URL}rest/V1/bookmarks/`,
                    JSON.stringify({'bookmark': bookmark}), true, 'application/json'
                )
                .done(response => {
                    if (response.id) {
                        this.bookmarkId = response.id;
                        this.changeFlagColor();
                    }
                })
                .fail(err => {
                    console.log('Error: ', err);
                });
        },
        deleteBookmark: function () {
            storage
                .delete(
                    `${BASE_URL}rest/V1/bookmarks/${encodeURIComponent(this.bookmarkId)}`
                )
                .done(response => {
                    if (response) {
                        this.bookmarkId = 0;
                        this.changeFlagColor();
                    }
                })
                .fail(err => {
                    console.log('Error: ', err);
                });
        },

    });
})
