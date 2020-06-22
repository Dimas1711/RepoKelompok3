package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.configfile.ServerApi;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class RegistrasiActivity extends AppCompatActivity {

    EditText fullname, pass, konfirm, email, nomer;
    Button register;
    RequestQueue requestQueue;
    String NameHolder, EmailHolder, PasswordHolder ;
    Boolean CheckEditText;
    TextView masuk;
    ProgressDialog progressDialog;
    ProgressBar progressBar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_registrasi);
        fullname = findViewById(R.id.edt_nama);
        email = findViewById(R.id.edt_email);
        pass = findViewById(R.id.edt_password);
        konfirm = findViewById(R.id.edt_konfrimasi);
        nomer = findViewById(R.id.edt_nomor);
        masuk = findViewById(R.id.masuk);
        requestQueue = Volley.newRequestQueue(RegistrasiActivity.this);
        progressDialog = new ProgressDialog(this);
        progressBar = new ProgressBar(RegistrasiActivity.this);
        masuk.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent login = new Intent(RegistrasiActivity.this , LoginActivity.class);
                startActivity(login);

            }
        });
        register = findViewById(R.id.btn_daftar);
        register.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v){
                UserRegistration();
            }
        });
    }

    public void UserRegistration() {
        final String nama_user = this.fullname.getText().toString().trim();
        final String email = this.email.getText().toString().trim();
        final String no_telp = this.nomer.getText().toString().trim();
        final String password = this.pass.getText().toString().trim();
        final String konfirm_pass = this.konfirm.getText().toString().trim();

        if (nama_user.matches("")){
            Toast.makeText(this, "Masukkan Nama Lengkap Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (email.matches("")){
            Toast.makeText(this, "Masukkan email Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (no_telp.matches("")){
            Toast.makeText(this, "Masukkan No Telpon Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (password.matches("")){
            Toast.makeText(this, "Masukkan password Anda", Toast.LENGTH_SHORT).show();
            return;
        }
        if (konfirm_pass.matches("")) {
            Toast.makeText(this, "Masukkan password Anda lagi", Toast.LENGTH_SHORT).show();
            return;
        }
        progressBar.setVisibility(View.GONE);
        masuk.setVisibility(View.GONE);

        StringRequest stringRequest = new StringRequest(Request.Method.POST, ServerApi.URL_REGIS,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonObject = new JSONObject(response);
                            String status = jsonObject.getString("status");
                            String error = jsonObject.getString("error");
                            String message = jsonObject.getString("message");

                            if (status.equals("200") && error.equals("false")) {
                                Toast.makeText(RegistrasiActivity.this, message, Toast.LENGTH_SHORT).show();
                                new Handler().postDelayed(new Runnable() {
                                    @Override
                                    public void run() {
                                        Intent intent2 = new Intent(RegistrasiActivity.this, LoginActivity.class);
                                        startActivity(intent2);
                                    }
                                }, 1500);
                            } else {
                                Toast.makeText(RegistrasiActivity.this, message, Toast.LENGTH_SHORT).show();
                                progressBar.setVisibility(View.GONE);
                                masuk.setVisibility(View.VISIBLE);
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                            progressBar.setVisibility(View.GONE);
                            Intent intent3 = new Intent(RegistrasiActivity.this, LoginActivity.class);
                            startActivity(intent3);
                            Toast.makeText(RegistrasiActivity.this, "Registrasi Berhasil", Toast.LENGTH_SHORT).show();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(RegistrasiActivity.this, "Error! " + error.toString(), Toast.LENGTH_SHORT).show();
                        progressBar.setVisibility(View.GONE);
                        masuk.setVisibility(View.VISIBLE);
                    }
                })
        {
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("nama_user",nama_user);
                params.put("email",email);
                params.put("no_telp",no_telp);
                params.put("password",password);
                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }


}
