package com.example.donasiyatim;

import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.LinearLayout;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

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

import java.util.ArrayList;
import java.util.List;

public class RiwayatFragment extends Fragment {
    RecyclerView recyclerView;
    List<ModelRiwayatDonasi> modelDataList;
    String val;
    String userid;
    AdapterRiwayatDonasi listAdapter;

    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_riwayat, container, false);
        recyclerView = v.findViewById(R.id.rv);
//        img = v.findViewById(R.id.imagelv);

        val = authdata.getInstance(getActivity()).getAksesData();
        Log.e("val","testes" + userid);
        //nama_user.setText(jenenge);

        loaddetail();
        //retrieveJSON();
        return v;
    }
    public void loaddetail()
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "Data_User/index_get?id_registrasi="
                +authdata.getInstance(getActivity()).getKodeUser(), new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    userid = arr1.getString("id_user");
                    retrieveJSON();
                    Log.e("userid" , "ff" + userid);

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

        };
        RequestQueue requestQueue = Volley.newRequestQueue(getActivity().getApplicationContext());
        requestQueue.add(senddata);
    }

    private void retrieveJSON()
    {
        StringRequest stringRequest  = new StringRequest(Request.Method.GET, ServerApi.IPServer + "riwayat/index_get?id_user="+userid  , new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Log.d("strrrrr", ">>" + response);
                try {
                    JSONObject obj  = new JSONObject(response);

                    modelDataList = new ArrayList<>();
                    JSONArray data = obj.getJSONArray("data");
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModelRiwayatDonasi playerModel = new ModelRiwayatDonasi();
                        JSONObject dataobj = data.getJSONObject(i);
                        playerModel.setTanggal(Util.settanggal(dataobj.getString("tanggal")));
                        playerModel.setJudul(dataobj.getString("judul"));
                        playerModel.setJumlah_donasi(Util.setformatrupiah(dataobj.getString("jumlah_donasi")));


                        modelDataList.add(playerModel);
                    }
                    setupListView();

                }
                catch (JSONException e)
                {
                    e.printStackTrace();
                }
            }
        },
                new Response.ErrorListener()
                {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.d("volley", "errornya : " + error.getMessage());
                    }
                });

        RequestQueue requestQueue = Volley.newRequestQueue(getActivity().getApplicationContext());
        requestQueue.add(stringRequest);
    }
    private void setupListView()
    {
        listAdapter = new AdapterRiwayatDonasi(getContext(), modelDataList);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getActivity().getApplicationContext());
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(listAdapter);
    }
}
