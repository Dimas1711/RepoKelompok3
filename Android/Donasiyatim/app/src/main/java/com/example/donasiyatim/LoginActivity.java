package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
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
import com.example.donasiyatim.configfile.AppController;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.authdata;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends AppCompatActivity {

    EditText email , password;
    Button login;
    TextView daftar, lupapass;
    ProgressBar pd;
    ProgressDialog progressDialog;
    String nama_user;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        progressDialog = new ProgressDialog(this);
        pd = new ProgressBar(LoginActivity.this);
        pd.setVisibility(View.GONE);
        email = findViewById(R.id.edt_email);
        password = findViewById(R.id.edt_password_login);
        daftar = findViewById(R.id.tvDaftarSekarang);
        daftar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent daftar = new Intent(LoginActivity.this, RegistrasiActivity.class);
                startActivity(daftar);
            }
        });
        lupapass = findViewById(R.id.tvLupaPassword);
        lupapass.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent lupa = new Intent(LoginActivity.this, LupaPass.class);
                startActivity(lupa);
            }
        });
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

    }
    public void login(){


        StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.IPServer, new Response.Listener<String>() {
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
                            datalogin.getString("token")
                    );
                    nama_user = datalogin.getString("nama");
                    Log.e("Nama" , "user" + nama_user);
                    pd.setVisibility(View.GONE);
                    if (datalogin.getString("role_id").equals("3")) {
                        Log.e("ser", "sep gan");
                        Intent login = new Intent(LoginActivity.this, MainActivity.class);
                        startActivity(login);

                    } else {
                        Toast.makeText(LoginActivity.this, "Aplikasi Hanya Untuk User . Silahkan Login Via Website YukDonasi" ,
                                Toast.LENGTH_SHORT).show();

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
                Toast.makeText(LoginActivity.this, "Gagal Login, " + error, Toast.LENGTH_SHORT).show();


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