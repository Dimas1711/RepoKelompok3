package com.example.donasiyatim.auth;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.MainActivity;
import com.example.donasiyatim.R;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.authdata;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends AppCompatActivity {

    EditText email , password;
    Button login;
    ProgressBar pd;
    ProgressDialog progressDialog;
    String nama_user;
    TextView dftr, lupa;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        progressDialog = new ProgressDialog(this);
        pd = new ProgressBar(LoginActivity.this);
        pd.setVisibility(View.GONE);
        email = findViewById(R.id.edt_email);
        password = findViewById(R.id.edt_password_login);
        lupa = findViewById(R.id.tvLupaPassword);
        login = findViewById(R.id.buttonLogin);
//        pb = findViewById(R.id.progressbar);
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                progressDialog.setMessage("Tunggu Beberapa Saat");
                progressDialog.show();
                pd.setVisibility(View.VISIBLE);
                if (email.getText().toString().isEmpty()){
                    Toast.makeText(LoginActivity.this, "Email Tidak Boleh Kosong", Toast.LENGTH_LONG).show();
                    progressDialog.dismiss();
                }else if (password.getText().toString().isEmpty()){
                    Toast.makeText(LoginActivity.this, "Password Tidak Boleh Kosong", Toast.LENGTH_LONG).show();
                    progressDialog.dismiss();
                }else {
                    login();
                }
            }
        });
        dftr = findViewById(R.id.tvDaftarSekarang);
        dftr.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent regis = new Intent(LoginActivity.this , RegistrasiActivity.class);
                startActivity(regis);
            }
        });

        lupa.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent lupapass = new Intent(LoginActivity.this , ResetPassActivity.class);
                startActivity(lupapass);
            }
        });


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
                        ActivityCompat.finishAffinity(LoginActivity.this);
                        finish();
                    }

                })
                .setNegativeButton("Tidak", null)
                .show();
    }

    public void login(){


        StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.URL_LOGIN, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    progressDialog.dismiss();
                    JSONObject res = new JSONObject(response);

                    JSONObject respon = res.getJSONObject("data");
                    Toast.makeText(LoginActivity.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
                    JSONObject datalogin = res.getJSONObject("data");
                    Log.e("ser", datalogin.getString("token"));
                    authdata.getInstance(getApplicationContext()).setdatauser(
                            datalogin.getString("status"),
                            datalogin.getString("id_registrasi"),
                            datalogin.getString("nama"),
                            datalogin.getString("token"),
                            datalogin.getString("role_id")
                    );
                    nama_user = datalogin.getString("nama");
                    Log.e("Nama" , "user" + nama_user);
                    pd.setVisibility(View.GONE);
                    if (datalogin.getString("role_id").equals("3")) {
                        Log.e("ser", "sep gan");
                        Intent intent = new Intent(LoginActivity.this, MainActivity.class);
                        startActivity(intent);

                    } else {
                        Toast.makeText(LoginActivity.this, "Aplikasi Hanya Untuk User . Silahkan Login Via Website Donasi Panti" , Toast.LENGTH_SHORT).show();

                    }
//                    } else {
//                        Toast.makeText(LoginActivity.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
//
//                    }

//                                pd.dismiss();

                } catch (JSONException e) {
//                                e.printStackTrace();
                    progressDialog.dismiss();
                    Log.e("errorgan", e.getMessage());
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
//                            pd.cancel();
                progressDialog.dismiss();
                Log.e("errornyaa ", "" + error);
                Toast.makeText(LoginActivity.this, "Gagal Login, " + "Email atau password salah !", Toast.LENGTH_SHORT).show();


            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("email", email.getText().toString());
                params.put("password", password.getText().toString());

                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(LoginActivity.this);

        requestQueue.add(senddata);
    }
}