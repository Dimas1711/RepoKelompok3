package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.example.donasiyatim.configfile.AppController;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.authdata;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class EditprofilActivity extends AppCompatActivity {

    EditText nama, email, pass;
    Button simpan, back;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_editprofil);

        nama = findViewById(R.id.edt_nama);
        email = findViewById(R.id.edt_email);
        pass = findViewById(R.id.edtpass);
        back = findViewById(R.id.kembali);
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent back = new Intent(EditprofilActivity.this, ProfilActivity.class);
                startActivity(back);

            }
        });
        simpandata();
        simpan = findViewById(R.id.simpan);
        simpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                update();

            }
        });
    }

    private void simpandata()//ini buat nampilin saldo
    {
        Log.e("TAG" , authdata.getInstance(getApplicationContext()).getAksesData());
        StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.IPServer+"Project/api/data_user/"+ authdata.getInstance(getApplicationContext()).getAksesData(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
//                pd.cancel();
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONObject arr = res.getJSONObject("data");
                    email.setText(arr.getString("email") );


                } catch (JSONException e) {
                    e.printStackTrace();
                    Log.e("erronya ",""+e);
                }
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.d("volley", "errornya : " + error.getMessage());
                    }
                }) {

            @Override
            public Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<String, String>();

                return params;
            }
        };

        AppController.getInstance().addToRequestQueue(senddata);
    }
    private void update(){
        StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.IPServer+"Project/api/data_user/" + authdata.getInstance(getApplicationContext()).getKodeUser(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject res = new JSONObject(response);
                    Log.d("error di ", response);
                    JSONObject respon = res.getJSONObject("respon");
                    if (respon.getBoolean("status")) {
                        Toast.makeText(getApplicationContext(), respon.getString("pesan"), Toast.LENGTH_SHORT).show();
//                        Intent akun = new Intent(ActivityEditDataDiri.this , FragmentAkun.class);
//                        startActivity(akun);

                    } else {
                        Toast.makeText(getApplicationContext(), respon.getString("pesan"), Toast.LENGTH_SHORT).show();


                    }

                } catch (JSONException e) {
//                                e.printStackTrace();
                    Log.e("errorgan", e.getMessage());
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
//                            pd.cancel();

                Log.e("errornyaa ", "" + error);
                Toast.makeText(getApplicationContext(), "Gagal, " + error, Toast.LENGTH_SHORT).show();


            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("email", email.getText().toString());
                params.put("nama",nama.getText().toString());
                params.put("password_baru",pass.getText().toString());


                return params;
            }
        };
        AppController.getInstance().addToRequestQueue(senddata);
    }
}
