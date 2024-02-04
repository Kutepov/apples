'use strict';

var Apple = function () {
    this.fall = function (appleId) {
        $.ajax({
            'url': '/apple/fall-to-ground',
            'method': 'get',
            'data': {'id': appleId},
            'success': function (data) {
                successResult('Яблоко упало!');
            },
            'error': function (data) {
                toastr.error(data.responseJSON.message);
            }
        });
    };

    this.eat = function (appleId, size) {
        $.ajax({
            'url': '/apple/eat',
            'method': 'get',
            'data': {'id': appleId, 'size': size},
            'success': function (data) {
                successResult('Яблоко откушено!');
            },
            'error': function (data) {
                toastr.error(data.responseJSON.message);
            }
        });
    };

    this.create = function (count) {
        $.ajax({
            'url': '/apple/create',
            'method': 'get',
            'data': {'count': count},
            'success': function (data) {
                successResult('Яблоки созданы!');
            },
            'error': function (data) {
                toastr.error(data.responseJSON.message);
            }
        });
    };
};

var apple = new Apple();

function successResult(message) {
    $.pjax.reload({container: '#apples', async: false});
    toastr.success(message);
}