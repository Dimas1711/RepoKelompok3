package com.example.donasiyatim;

import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.authdata;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class HomeFragment extends Fragment {
    TextView nama_user, saldo;
    Button btn_dompet;
    String id_regis;
    String saldoku;

    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_home, container, false);

        nama_user = v.findViewById(R.id.tv_namauser);
        saldo = v.findViewById(R.id.tv_saldo);
        btn_dompet = v.findViewById(R.id.btn_dompet);

        String jenenge = getActivity().getIntent().getStringExtra("jeneng");
//        id_regis = getActivity().getIntent().getStringExtra("id_registrasi");
//        Log.e("id_register" ,""+ id_regis);
        String val = authdata.getInstance(getActivity()).getKodeUser();
        Log.e("val","testes" + val);
        nama_user.setText(jenenge);
        loaddetail();

        return v;
    }

    private void loaddetail()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "data_user/index_get", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    saldo.setText(arr1.getString("finansial"));
                    saldoku = arr1.getString("finansial");
                    Log.e("saldo", ""+saldoku);
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
                params.put("id_registrasi", authdata.getInstance(getActivity()).getKodeUser());
                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(getActivity().getApplicationContext());

        requestQueue.add(senddata);
    }
}
