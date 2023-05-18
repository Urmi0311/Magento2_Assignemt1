define([
    'uiComponent',
    'ko',
    'mage/storage',
    'jquery',
    'mage/translate'
],function (
    Component,
    ko,
    storage,
    $,
    $t
) {
    'use strict';

    return Component.extend({
        defaults: {

            sku: ko.observable('24-MB01 '),
            placeholder: 'Example: 24-MB01',
            messageResponse: ko.observable(''),
            isSuccess: ko.observable(false)
        },
        initialize(){
            this._super();

            console.log('the Sku has been loaded');
        },
        handleSubmit(){

            this.messageResponse('');
            this.isSuccess(false);


            storage.get(`rest/V1/products/${this.sku()}`)
                .done(response =>{
                    this.messageResponse($t('Product Found %1').replace('%1',` ${response.name}`));
                    this.isSuccess(false);
                })
                .fail(() => {
                    this.messageResponse($t('Product not found'));
                    this.isSuccess(false);
                })

        }
    });


})
