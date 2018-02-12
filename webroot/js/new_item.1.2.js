$(document).ready(function() {
    var addButton = $('#add-button');
    var deleteButton = $('#delete-button');
    var optionCount = $('.option').length;
    var optionGrid = $('#option-grid');
    addButton.click(function(evt) {
        evt.preventDefault();
        var newOption = '<div class="option">';
        newOption += '<div class="mdl-cell--4-col">';
        newOption += '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label text is-upgraded">';
        newOption += '<input id="option-' + optionCount + '-label" class="mdl-textfield__input" type="text" name="options[' + optionCount + '][label]" />';
        newOption += '<label class="mdl-textfield__label" for="option-' + optionCount + '-label"> Label </label>';
        newOption += "</div>";
        newOption += "</div>";
        newOption += '<div class="mdl-cell--4-col">';
        newOption += '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label text is-upgraded">';
        newOption += '<input id="option-' + optionCount + '-value" class="mdl-textfield__input" type="text" name="options[' + optionCount + '][value]" />';
        newOption += '<label class="mdl-textfield__label" for="option-' + optionCount + '-value"> Value </label>';
        newOption += "</div>";
        newOption += "</div>";
        newOption += '<div class="mdl-cell--4-col">';
        newOption += '<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label text is-upgraded">';
        newOption += '<input id="option-' + optionCount + '-hexval" class="mdl-textfield__input" type="text" name="options[' + optionCount + '][hexval]" />';
        newOption += '<label class="mdl-textfield__label" for="option-' + optionCount + '-hexval"> Hex </label>';
        newOption += "</div>";
        newOption += "</div>";
        newOption += "</div>";
        optionCount++;
        optionGrid.append(newOption);
        //handles MDL clean up
        componentHandler.upgradeDom();
    });
    deleteButton.click(function(evt) {
        evt.preventDefault();
        if (optionCount === 1) {
            return;
        }
        optionCount--;
        $('.option:last').remove();
    });
});