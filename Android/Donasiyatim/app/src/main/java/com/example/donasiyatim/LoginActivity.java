package com.example.donasiyatim;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
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

    Button buttonlogin;
    TextView daftar_masuk, belumpunyaakun, lupapass;
    EditText email , pass;
    ProgressBar progress;
    ProgressDialog progressDialog;
    private static String URL_LOGIN = "";
    Boolean CheckEditText;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        email = findViewById(R.id.edt_email);
        pass = findViewById(R.id.edt_password_login);
        daftar_masuk = findViewById(R.id.tvDaftarSekarang);
        progressDialog = new ProgressDialog(LoginActivity.this);
        progress = findViewById(R.id.progressbar);
        belumpunyaakun = findViewById(R.id.tvBelumPunyaAkun);
        lupapass = findViewById(R.id.tvLupaPassword);

        daftar_masuk.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent regis = new Intent(LoginActivity.this , RegistrasiActivity.class);
                startActivity(regis);

            }
        });

        buttonlogin = findViewById(R.id.buttonLogin);
        buttonlogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent masuk = new Intent(LoginActivity.this, MainActivity.class);
//                startActivity(masuk);

//                progressDialog.setMessage("Authenticating...");
//                progressDialog.setCancelable(false);
//                progressDialog.show();
                if (email.getText().toString().isEmpty()) {
                    Toast.makeText(LoginActivity.this, "Email Tidak Boleh Kosong", Toast.LENGTH_LONG).show();
                    progressDialog.dismiss();
//
                } else if (pass.getText().toString().isEmpty()) {
                    Toast.makeText(LoginActivity.this, "Password Tidak Boleh Kosong", Toast.LENGTH_LONG).show();
//                    pd.dismiss();

                } else {
                    StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.URL_LOGIN, new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            try {
                                JSONObject res = new JSONObject(response);

                                JSONObject respon = res.getJSONObject("respon");
                                if (respon.getBoolean("status")) {
                                    Toast.makeText(LoginActivity.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
                                    JSONObject datalogin = res.getJSONObject("datauser");
                                    JSONObject dataauth = res.getJSONObject("dataauth");
                                    Log.e("ser", datalogin.getString("akses_data"));
                                    authdata.getInstance(getApplicationContext()).setdatauser(
                                            datalogin.getString("level"),
                                            datalogin.getString("kode_user"),
                                            datalogin.getString("nama_user"),
                                            datalogin.getString("akses_data"),
                                            datalogin.getString("token")
                                    );
//                                    Intent masuk = new Intent(ActivityMasuk.this , ActivityBeranda.class);
//                                    startActivity(masuk);
                                    if (datalogin.getString("l").equals("3")) {
                                        Log.e("ser", "sep gan");
                                        Intent intent = new Intent(LoginActivity.this, MainActivity.class);
                                        startActivity(intent);

                                    } else {
                                        Toast.makeText(LoginActivity.this, "Aplikasi Hanya Untuk User. Silahkan Login Via Website " + ServerApi.IPServer, Toast.LENGTH_SHORT).show();

                                    }
                                } else {
                                    Toast.makeText(LoginActivity.this, respon.getString("pesan"), Toast.LENGTH_SHORT).show();
                                }
                                //                 progressDialog.dismiss();

                            } catch (JSONException e) {
                                //                               e.printStackTrace();
                                Log.e("errorgan", e.getMessage());
                            }

                        }
                    }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
//                            pd.cancel();

                                Log.e("errornyaa ", "" + error);
                                Toast.makeText(LoginActivity.this, "Gagal Login, " + error, Toast.LENGTH_SHORT).show();
                            }

                        }) {
                        @Override
                        protected Map<String, String> getParams() throws AuthFailureError {
                            Map<String, String> params = new HashMap<>();
                            params.put("emailnya", email.getText().toString());
                            params.put("passwordnya", pass.getText().toString());

                            return params;
                        }
                    };
                    AppController.getInstance().addToRequestQueue(senddata);
                }

                }
            });




}
    private void login (String email, String password) {


    }
    }