package com.friendly.ffr.friendlyfriendreminder;


import android.app.Application;
import android.content.Context;

/**
 * Created by kevin on 1/17/15.
 */
public class FriendlyFriendReminder extends Application {
    private static Context context;

    @Override
    public void onCreate() {
        super.onCreate();
        FriendlyFriendReminder.context = getApplicationContext();
    }

    public static Context getAppContext() {
        return FriendlyFriendReminder.context;
    }
}
