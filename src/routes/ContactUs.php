<?php


namespace Lakm\Contact\routes;


use Illuminate\Support\Facades\Route;
use Lakm\Contact\Http\Controllers\ContactController;
use Lakm\Contact\Http\Controllers\ContactReplyController;
use Lakm\Contact\Http\Controllers\ReplyContactController;
use Lakm\Contact\Http\Controllers\ReplyController;


class ContactUs
{
    public static function routes()
    {
        Route::group(['middleware' => 'web', 'prefix' => 'contact-us', 'as'=>'contactUs.'], function () {
            Route::get('contact', [ContactController::class, 'view']);

            Route::group(['prefix' => 'admins'], function () {
                Route::get('all-contacts', [ContactController::class, 'index'])
                    ->name('admins.contacts');

                Route::get('all-contacts/filter',
                    [ContactController::class, 'filterData'])
                    ->name('admins.contacts-filter');

                Route::get('all-contacts/seacrh',
                    [ContactController::class, 'search'])
                    ->name('admins.contacts-search');

                Route::get('{user}/contacts', [ContactController::class, 'show'])
                    ->name('admins.user-contact');

                Route::get('contacts/{contact}/reply',
                    [ContactReplyController::class, 'create'])
                    ->name('admins.reply');

                Route::get('contacts/{contact}/replies',
                    [ContactReplyController::class, 'show'])
                    ->name('admins.getReply');

                Route::post('contacts/{contact}/reply',
                    [ContactReplyController::class, 'handleReply'])
                    ->name('admins.handleReply');

                Route::delete('contacts/{email}/delete',
                    [ContactController::class, 'deleteByEmail'])->name('deleteContactByMail');

                Route::delete('contacts/{contact}/delete-by-id',
                    [ContactController::class, 'deleteById'])->name('deleteContactById');

                Route::delete('contacts/delete',
                    [ContactController::class, 'deleteManyByEmail'])->name('deleteManyContactsByMail');

                Route::delete('contacts/delete-many-by-id',
                    [ContactController::class, 'deleteManyById'])->name('deleteManyContactsById');

                Route::get('replies', [ReplyController::class, 'index'])->name('allReplies');

                Route::get('contacts/{contact}', [ContactController::class, 'showById'])->name('inquery');

                Route::delete('replies/{reply}/delete', [ReplyController::class, 'destroy'])->name('replyDelete');

                Route::delete('replies/delete-many-aaa', [ReplyController::class, 'destroyMany'])->name('manyReplyDelete');

            });


            Route::post('contact', [ContactController::class, 'send'])->name('contact');

        });
    }

}