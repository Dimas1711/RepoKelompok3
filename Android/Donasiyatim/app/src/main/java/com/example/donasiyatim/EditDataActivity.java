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

public class EditDataActivity extends AppCompatActivity {
    String id_regis, email, nama, alamat,no_telp, no_rek, nama_rek, nama_bank, tanggal_lahir, jenis_kelamin, tempat_lahir, nik, pekerjaan, finansial;
    EditText ednama, edalamat, edno_telp, edpekerjaan, edno_rek,ednama_rek,ednama_bank;
    Button back, simpan;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_data);

        back = findViewById(R.id.exit);
        simpan = findViewById(R.id.simpaned);

        ednama = findViewById(R.id.ednama);
        edalamat = findViewById(R.id.edalamat);
        edno_telp = findViewById(R.id.ednomor);
        edpekerjaan = findViewById(R.id.edkerja);
        ednama_bank = findViewById(R.id.edbank);
        edno_rek = findViewById(R.id.ednorek);
        ednama_rek = findViewById(R.id.ednamarek);


        id_regis = authdata.getInstance(EditDataActivity.this).getKodeUser();
        tanggal_lahir = getIntent().getStringExtra("tanggal_lahir");
        jenis_kelamin = getIntent().getStringExtra("jenis_kelamin");
        tempat_lahir = getIntent().getStringExtra("tempat_lahir");
        nik = getIntent().getStringExtra("nik");
        finansial = getIntent().getStringExtra("finansial");
        email = getIntent().getStringExtra("email");

        Log.e("asd",""+id_regis);
        Log.e("asd",""+tanggal_lahir);
        Log.e("asd",""+jenis_kelamin);
        Log.e("asd",""+tempat_lahir);
        Log.e("asd",""+nik);
        Log.e("asd",""+finansial);
        Log.e("asd",""+email);

        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent back = new Intent(EditDataActivity.this, MainActivity.class);
                startActivity(back);

            }
        });

        simpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (ednama.getText().toString().equals("") || edalamat.getText().toString().equals("") ||
                        edno_telp.getText().toString().equals("") || edpekerjaan.getText().toString().equals("") ||
                        edno_rek.getText().toString().equals("") || ednama_rek.getText().toString().equals("")
                        || ednama_bank.getText().toString().equals(""))
                {
                    Toast.makeText(EditDataActivity.this,"Field tidak boleh kosong", Toast.LENGTH_SHORT).show();
                }
                else
                {
                    update();
                    //Toast.makeText(EditDataActivity.this,"Bener e", Toast.LENGTH_SHORT).show();
                }
            }
        });
    }

    private void update()
    {
        StringRequest senddata = new StringRequest(Request.Method.PUT, ServerApi.IPServer + "data_user/index_put",
                new Response.Listener<String>(){

                    @Override
                    public void onResponse(String response) {
                        try {
                            Toast.makeText(EditDataActivity.this, "Update User Berhasil", Toast.LENGTH_SHORT).show();
                            Intent intent = new Intent(EditDataActivity.this, MainActivity.class);
                            startActivity(intent);
                        } catch (Exception e) {
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
                params.put("id_registrasi", id_regis);
                params.put("nama_user" , ednama.getText().toString());
                params.put("alamat" , edalamat.getText().toString());
                params.put("no_telp" , edno_telp.getText().toString());
                params.put("email" , email);
                params.put("no_rekening" , edno_rek.getText().toString());
                params.put("nama_rekening" , ednama_rek.getText().toString());
                params.put("nama_bank" , ednama_bank.getText().toString());
                params.put("tanggal_lahir", tanggal_lahir);
                params.put("jenis_kelamin", jenis_kelamin);
                params.put("tempat_lahir", tempat_lahir);
                params.put("nik", nik);
                params.put("pekerjaan", edpekerjaan.getText().toString());
                params.put("finansial", finansial);
                return params;

            }

        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(senddata);
    }

}
