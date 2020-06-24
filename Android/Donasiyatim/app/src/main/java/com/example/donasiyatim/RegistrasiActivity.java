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
    String NameHolder, EmailHolder, PasswordHolder, nama_user, eemail, password, konf_password ;
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
                NameHolder = fullname.getText().toString();
                EmailHolder = email.getText().toString();
                PasswordHolder = pass.getText().toString();
                if (NameHolder.equals("") || EmailHolder.equals("") || PasswordHolder.equals(""))
                {
                    Toast.makeText(RegistrasiActivity.this, "Inputan tidak boleh kosong", Toast.LENGTH_SHORT).show();
                }
                else
                {
                    UserRegistration();
                }

            }
        });
    }

    public void UserRegistration() {

        StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.IPServer + "registrasi/index_get",
                new Response.Listener<String>(){

                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject res = new JSONObject(response);
                            if (res.optString("status").equals("true")) {
                                Toast.makeText(RegistrasiActivity.this, res.getString("pesan"), Toast.LENGTH_SHORT).show();
                                Intent intent = new Intent(RegistrasiActivity.this, LoginActivity.class);
                                startActivity(intent);
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }


                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.d("volley", "errornya : " + error.getMessage());
                    }
                }) {
            protected Map<String, String> getParams(){
                Map<String , String> params = new HashMap<>();
                params.put("nama" , NameHolder);
                params.put("password" , PasswordHolder);
                params.put("email" , EmailHolder);

                return params;
            }

        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(senddata);
    }


}
