package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class RegistrasiActivity extends AppCompatActivity {

    EditText fullname, pass, konfirm, email;
    Button register;
    RequestQueue requestQueue;
    String NameHolder, EmailHolder, PasswordHolder ;
    ProgressDialog progressDialog;
    String HttpUrl = "http://192.168.1.2/RepoKelompok3/Android/php/Registration.php";
    Boolean CheckEditText;
    TextView masuk;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_registrasi);
        fullname = findViewById(R.id.edt_nama);
        email = findViewById(R.id.edt_email);
        pass = findViewById(R.id.edt_password);
        konfirm = findViewById(R.id.edt_konfrimasi);
        masuk = findViewById(R.id.masuk);
        requestQueue = Volley.newRequestQueue(RegistrasiActivity.this);
        progressDialog = new ProgressDialog(RegistrasiActivity.this);
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
            public void onClick(View v) {
                checkedittext();
                progressDialog.setMessage("Tunggu Sebentar");
                progressDialog.show();
                if (!pass.getText().toString().equals(konfirm.getText().toString())){
                    Toast.makeText(RegistrasiActivity.this , "Password Yang Dimasukkan Salah", Toast.LENGTH_SHORT).show();
                    progressDialog.dismiss();
                }else if (CheckEditText){
                    setRegister();
                    Intent login = new Intent(RegistrasiActivity.this , LoginActivity.class);
                    startActivity(login);
                    finish();
                }else {

                    Toast.makeText(RegistrasiActivity.this , "Isi Seluruh Data" , Toast.LENGTH_SHORT).show();
                    progressDialog.dismiss();
                }

            }
        });

    }
    public void setRegister(){
        progressDialog.setMessage("Tunggu Sebentar , Data Anda Sedang Ditambahkan Ke Dalam Server");
        progressDialog.show();
        StringRequest stringRequest =new StringRequest(Request.Method.POST, HttpUrl,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        progressDialog.dismiss();
                        Toast.makeText(RegistrasiActivity.this, response, Toast.LENGTH_SHORT).show();
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        progressDialog.dismiss();
                        Log.e("volley" , error.toString());
                        Toast.makeText(RegistrasiActivity.this, error.toString(), Toast.LENGTH_SHORT).show();
                    }
                }){
            protected Map<String, String> getParams(){
                Map<String , String> params = new HashMap<>();
                params.put("nama" ,NameHolder);
                params.put("email" , EmailHolder);
                params.put("password" , PasswordHolder);

                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(RegistrasiActivity.this);

        requestQueue.add(stringRequest);
    }
    public void checkedittext(){
        NameHolder = fullname.getText().toString().trim();
        EmailHolder = email.getText().toString().trim();
        PasswordHolder = pass.getText().toString().trim();

        if (TextUtils.isEmpty(NameHolder) || TextUtils.isEmpty(EmailHolder) || TextUtils.isEmpty(PasswordHolder)){
            CheckEditText = false;
        } else {
            CheckEditText = true;
        }
    }

}
