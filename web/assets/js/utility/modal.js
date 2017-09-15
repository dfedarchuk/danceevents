/* Checks namespace existence */
if (typeof eDirectory == 'undefined') {
    eDirectory = {};
}

eDirectory.Utility = eDirectory.Utility || {};

/**
 * Creates a new modal, inserting the required HTML code if necessary
 * @param identifier The Id of the new modal
 * @param title The title which will appear at the modal header
 * @param content The content which will appear in the modal body
 * @param footer The content which will appear in the modal footer
 * @param modalOptions The bootstrap modal options
 * @constructor
 */
eDirectory.Utility.Modal = function (identifier, title, content, footer, modalOptions) {
    this.identifier = identifier;
    this.title = title;
    this.footerContent = footer;
    this.bodyContent = content;
    this.element = null;
    this.modalOptions = modalOptions || {
            'show': false
        };

    this.create();
};

/**
 * Ensures the existence of the required HTML to properly show the modal
 */
eDirectory.Utility.Modal.prototype.create = function () {
    var element = $("#" + this.identifier);

    if (element.length > 0) {
        this.element = element.first();
        element.find(".modal-content")
            .empty()
            .append([
                this._createHeader(),
                this._createBody(),
                this._createFooter(),
            ]);
    } else {
        this.element = this._createModal();
        $("body").append(this.element);
        this.element.modal(this.modalOptions);
    }
};

/**
 * Displays modal
 */
eDirectory.Utility.Modal.prototype.show = function () {
    this.element.modal("show");
};

/**
 * Hides modal
 */
eDirectory.Utility.Modal.prototype.hide = function () {
    this.element.modal("hide");
};

/**
 * Toggles modal
 */
eDirectory.Utility.Modal.prototype.toggle = function () {
    this.element.modal("toggle");
};

/**
 * Removes modal HTML
 */
eDirectory.Utility.Modal.prototype.delete = function () {
    this.element.remove();
};

/**
 * Set Modal Title
 */
eDirectory.Utility.Modal.prototype.setTitle = function (newTitle) {
    this.title = newTitle;
    var titleElement = this.element.find(".modal-title");

    if (titleElement.length) {
        titleElement.first().html(newTitle);
    } else {
        this.element.find(".modal-header").remove();
        this.element.find(".modal-content").prepend(this._createHeader());
    }
};

/**
 * Set Modal Footer
 */
eDirectory.Utility.Modal.prototype.setFooter = function (newFooter) {
    this.footerContent = newFooter;

    var footerElement = this.element.find(".modal-footer");

    if (footerElement.length) {
        footerElement.first().html(this.footerContent);
    } else {
        this.element.find(".modal-content").append(this._createFooter());
    }
};

/**
 * Set Modal Content
 */
eDirectory.Utility.Modal.prototype.setContent = function (newContent) {
    this.bodyContent = newContent;
    var contentElement = this.element.find(".modal-body");

    if (contentElement.length) {
        contentElement.first().html(this.bodyContent);
    } else {
        this.create();
    }
};

/**
 * Creates HTML DOM for modal Headers
 * @returns {jQuery|HTMLElement}
 * @private
 */
eDirectory.Utility.Modal.prototype._createHeader = function () {
    var modalHeader = null;

    if (this.title) {
        modalHeader = $('<div>', {
            'class': 'modal-header'
        });
        var modalHeaderCloseButton = $('<button>', {
            'class':        'close',
            'type':         'button',
            'data-dismiss': 'modal',
            'aria-label':   'Close',
            'html':         '<span aria-hidden="true">&times;</span>'
        });
        var modalHeaderTitle = $('<h4>', {
            'class': 'modal-title',
            'html':  this.title
        });

        modalHeader.append([modalHeaderCloseButton, modalHeaderTitle]);
    }

    return modalHeader;
};

/**
 * Creates HTML DOM for modal Body
 * @returns {jQuery|HTMLElement}
 * @private
 */
eDirectory.Utility.Modal.prototype._createBody = function () {
    return $('<div>', {
        'class': 'modal-body',
        'html':  this.bodyContent
    });
};

/**
 * Creates HTML DOM for modal Footer
 * @returns {jQuery|HTMLElement}
 * @private
 */
eDirectory.Utility.Modal.prototype._createFooter = function () {
    return this.footerContent ? $('<div>', {
        'class': 'modal-footer',
        'html':  this.footerContent
    }) : null;
};

/**
 * Creates HTML DOM for the entire modal
 * @returns {jQuery|HTMLElement}
 * @private
 */
eDirectory.Utility.Modal.prototype._createModal = function () {
    var modal = $('<div>', {'id': this.identifier, 'class': 'modal fade'});
    var modalDialog = $('<div>', {'class': 'modal-dialog'});
    var modalContent = $('<div>', {'class': 'modal-content'});

    modalContent.append([
        this._createHeader(),
        this._createBody(),
        this._createFooter()
    ]);

    modalDialog.append(modalContent);
    modal.append(modalDialog);
    return modal;
};



