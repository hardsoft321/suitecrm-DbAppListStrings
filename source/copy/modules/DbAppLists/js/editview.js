/**
 * @license http://hardsoft321.org/license/ GPLv3
 * @author Evgeny Pervushin <pea@lab321.ru>
 */

$('body').append('<style>.remove_item_button {display: none}</style>')

SUGAR.util.doWhen("typeof lab321 != 'undefined' && typeof lab321.multiform != 'undefined' && lab321.multiform['DbAppListStrings'] && lab321.multiform['DbAppListStrings'].ready", function() {
    var formname = 'EditView';

    $('#name, [name$="\\[name\\]"]')
    .attr('onkeyup', 'translitField(this)')
    .attr('onchange', 'translitField(this)')
    .each(function() {this.onchange()})

    addToValidate(formname, 'uniq_name', 'DBNameRaw', false, 'Название указывается латиницей (может быть буквенно-цифровым, должно начинаться с буквы и не должно содержать пробелов).'/*SUGAR.language.get("ModuleBuilder", "LBL_JS_VALIDATE_NAME")*/);
    addToValidate(formname+'_DbAppListStrings', 'uniq_name', 'DBNameRaw', false, 'Название указывается латиницей (может быть буквенно-цифровым, должно начинаться с буквы и не должно содержать пробелов).'/*SUGAR.language.get("ModuleBuilder", "LBL_JS_VALIDATE_NAME")*/);

    addToValidateCallback(formname, 'uniq_name', '', false, 'Справочник с таким именем существует', function(formname, name) {
        var error = true;
        ajaxStatus.showStatus(SUGAR.language.get('app_strings','LBL_SAVING'));
        $.ajax('index.php?module=DbAppLists&action=validate', {
            data: {
                record: $('form[name="'+formname+'"] [name="duplicateSave"]').val() != 'true' ? $('form[name="'+formname+'"] [name="record"]').val() : ''
                , uniq_name: $('form[name="'+formname+'"] [name="uniq_name"]').val()
            }
            , dataType: 'json'
            , async: false
            , cache: false
            , type: 'POST'
        })
        .done(function(data) {
            if(!data || (typeof data.errors !== 'object')) {
                alert("Произошла ошибка. Попробуйте перезагрузить страницу.");
                return;
            }
            if(data.errors.length === 0) {
                error = false;
            }
        })
        .always(function() {
            ajaxStatus.hideStatus();
        }).fail(function(data) {
            var breakHtml = data.responseText.indexOf('<!DOCTYPE');
            text = breakHtml >= 0 ? data.responseText.substr(0, breakHtml) : data.responseText;
            if(!text.length) {
                text = 'Запрос не был выполнен. Попробуйте обновить страницу.';
            }
            alert(text);
        });
        return !error;
    });

    addToValidateCallback(formname, 'DbAppListStrings_multiform_validation', '', false, 'Значения должны быть уникальны по Уникальному имени и Языку', function(formname, name) {
        var grouped = {};
        var error = false;
        $('.multiform.'+"{$items_module}"+' .editlistitem').not('.item_template').filter(function(i, v) {
            return $(v).find('.item_deleted').length == 0
        }).each(function() {
            var uniq_name = $(this).find('[name$="\\[uniq_name\\]"]').val();
            var lang = $(this).find('[name$="\\[lang\\]"]').val();
            if(uniq_name && lang) {
                if(!grouped[uniq_name]) {
                    grouped[uniq_name] = [];
                    grouped[uniq_name][lang] = 1;
                }
                else if(!grouped[uniq_name][lang]) {
                    grouped[uniq_name][lang] = 1;
                }
                else {
                    error = true;
                }
            }
        })
        return !error;
    });

    $('#maxlen').attr('data-stringmaxlen', $('[name$=\\[uniq_name\\]]').attr('maxlength'))

    addToValidateCallback(formname, 'maxlen', '', false, 'Слишком большая длина (максимум '+$('#maxlen').attr('data-stringmaxlen')+')', function(formname, name) {
        var error = parseInt($('#maxlen').val(), 10) > parseInt($('#maxlen').attr('data-stringmaxlen'), 10);
        return !error;
    });

    addToValidateCallback(formname, 'DbAppListStrings_multiform_validation', '', false, 'Превышена длина одного из значений', function(formname, name) {
        var error = false;
        $('.editlistitem [name$=\\[uniq_name\\]]').each(function() {
            if((this.value || '').length > parseInt($(this).attr('maxlength'), 10)) {
                add_error_style(formname, this.name, 'Превышена длина значения');
                error = true;
            }
        });
        return !error;
    });

    if($('form[name="'+formname+'"] [name="record"]').val() && $('form[name="'+formname+'"] [name="duplicateSave"]').val() != 'true') {
        $('#uniq_name, .editlistitem.bean-id [name$=\\[uniq_name\\]], #maxlen').attr('disabled', 'disabled').attr('readonly', 'readonly')
    }
    else {
        $('#maxlen').val($('#maxlen').attr('data-stringmaxlen'))
    }

    $('#maxlen').change(function(){
        $('[name$=\\[uniq_name\\]]').attr('maxlength', $(this).val())
    }).change()
});

function translitField(field) {
    var srcField = $(field)
    var destField = srcField.closest('.editlistitem').find('[name$="\\[uniq_name\\]"]')
    if(!destField.length) {
        destField = $('#uniq_name')
    }
    if(destField.attr('disabled')) {
        return;
    }
    var oldSrcVal = srcField.attr('data-oldval');
    srcField.attr('data-oldval', srcField.val())
    var maxlength = destField.attr('maxlength');
    var oldlat = (cyr2lat(oldSrcVal) || '').slice(0, maxlength);
    if(!destField.val() || (destField.val() == oldlat)) {
        var lat = (cyr2lat(srcField.val()) || '').slice(0, maxlength);
        destField.val(lat)
    }
}
