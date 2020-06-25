package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.widget.Toast;

import com.example.donasiyatim.configfile.authdata;

import static java.lang.Thread.sleep;

public class SplashScreen extends AppCompatActivity {
    private int waktu = 1000;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash_screen);
        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                try {
                    sleep(1000);
                    SplashScreen.this.finish();

                    if (authdata.getInstance(getApplicationContext()).ceklogin()) {
                        if(authdata.getInstance(getApplicationContext()).getLevel().equals("3")){
                            Intent home = new Intent(SplashScreen.this, MainActivity.class);
                            startActivity(home);
                        }else {
                            Intent home = new Intent(SplashScreen.this, LoginActivity.class);
                            startActivity(home);
                        }

                    } else {

                        Intent home = new Intent(SplashScreen.this, LoginActivity.class);
                        startActivity(home);
                    }


                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
            }
        }, waktu);
    }
}