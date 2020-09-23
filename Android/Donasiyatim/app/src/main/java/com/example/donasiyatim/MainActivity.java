package com.example.donasiyatim;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.fragment.app.Fragment;

import android.content.DialogInterface;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;

import com.example.donasiyatim.botNav.AkunFragment;
import com.example.donasiyatim.botNav.DonasiFragment;
import com.example.donasiyatim.botNav.HomeFragment;
import com.example.donasiyatim.botNav.NotificationFragment;
import com.example.donasiyatim.botNav.RiwayatFragment;
import com.example.donasiyatim.configfile.authdata;
import com.google.android.material.bottomnavigation.BottomNavigationView;

public class MainActivity extends AppCompatActivity {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        BottomNavigationView bottomNav = findViewById(R.id.bottom_navigation);
        bottomNav.setOnNavigationItemSelectedListener(navListenener);
        String level = authdata.getInstance(getApplicationContext()).getLevel();
        Log.e("level" , "ff" + level);
        getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container, new HomeFragment()).commit();
    }
    public void onBackPressed() {
        new AlertDialog.Builder(this)
                .setIcon(R.drawable.ic_home)
                .setTitle("Keluar Aplikasi")
                .setMessage("Apakah Anda Ingin Keluar Dari Aplikasi?")
                .setPositiveButton("Ya", new DialogInterface.OnClickListener()
                {
                    @Override
                    public void onClick(DialogInterface dialog, int which) {
                        ActivityCompat.finishAffinity(MainActivity.this);
                        finish();
                    }

                })
                .setNegativeButton("Tidak", null)
                .show();
    }
    private BottomNavigationView.OnNavigationItemSelectedListener navListenener =
            new BottomNavigationView.OnNavigationItemSelectedListener() {
                @Override
                public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                    Fragment selectedFragment = null;

                    switch (item.getItemId())
                    {
                        case R.id.nav_home :
                            selectedFragment = new HomeFragment();
                            break;
                        case R.id.nav_donasi :
                            selectedFragment = new DonasiFragment();
                            break;
                        case R.id.nav_riwayat :
                            selectedFragment = new RiwayatFragment();
                            break;
                        case R.id.notif :
                            selectedFragment = new NotificationFragment();
                            break;
                        case R.id.nav_akun :
                            selectedFragment = new AkunFragment();
                            break;
                    }
                    getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container, selectedFragment).commit();
                    return true;
                }
            };
}
