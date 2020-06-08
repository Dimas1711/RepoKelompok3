package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
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
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.Util;
import com.example.donasiyatim.configfile.authdata;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class TopupActivity extends AppCompatActivity {
    TextView rp50, rp100, rp150, rp200;
    EditText isi;
    Button btn;
    String id_user, nama;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_topup);

        id_user = getIntent().getStringExtra("id_user");
        nama = getIntent().getStringExtra("nama_user");

        rp50 = findViewById(R.id.rp50);
        rp100 = findViewById(R.id.rp100);
        rp150 = findViewById(R.id.rp150);
        rp200 = findViewById(R.id.rp200);
        isi = findViewById(R.id.uang_e);
        btn = findViewById(R.id.btn_isisaldo);


        rp50.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                isi.setText("50000");
            }
        });
        rp100.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                isi.setText("100000");
            }
        });
        rp150.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                isi.setText("150000");
            }
        });
        rp200.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                isi.setText("200000");
            }
        });

        btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                if (isi.getText().toString().equals(""))
                {
                    Toast.makeText(TopupActivity.this,"Silahkan Pilih Jumlah Top Up", Toast.LENGTH_SHORT).show();
                }
                else {
//                loaddetail();
                    Intent intent = new Intent(TopupActivity.this, UploadFotoActivity.class);
                    intent.putExtra("jumlah_inginkan", isi.getText().toString());
                    Log.e("uang", "" + intent.putExtra("jumlah_inginkan", isi.getText().toString()));
                    intent.putExtra("id_user", id_user);
                    intent.putExtra("nama_user", nama);
                    startActivity(intent);
                }
            }
        });
    }

}
