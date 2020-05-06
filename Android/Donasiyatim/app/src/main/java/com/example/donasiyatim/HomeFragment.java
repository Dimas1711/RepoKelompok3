package com.example.donasiyatim;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.annotation.PluralsRes;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentTransaction;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.Util;
import com.example.donasiyatim.configfile.authdata;
import com.example.moeidbannerlibrary.banner.BannerLayout;
import com.example.moeidbannerlibrary.banner.BaseBannerAdapter;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class HomeFragment extends Fragment implements ListAdapter.OnItemClickListener {
    public static final String EXTRA_ID = "id_kasus";
    public static final String EXTRA_ID_PANTI = "id_panti";
    TextView nama_user, saldo;
    ImageView img;
    Button btn_dompet;
    String id_regis;
    String saldoku;
    RecyclerView rv;
    List<ModelData> modelDataList;
    ListAdapter listAdapter;

    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_home, container, false);

        nama_user = v.findViewById(R.id.tv_namauser);
        saldo = v.findViewById(R.id.tv_saldo);
        btn_dompet = v.findViewById(R.id.btn_dompet);
        rv = v.findViewById(R.id.rv);
        img = v.findViewById(R.id.img_kasus);
        BannerLayout banner= v.findViewById(R.id.Banner);

        List<String> urls = new ArrayList<>();
        urls.add("https://ecs7.tokopedia.net/blog-tokopedia-com/uploads/2018/10/DONASI-PALU-1068x601.jpg");
        urls.add("https://blog.kitabisa.com/wp-content/uploads/2019/09/Featured-Images-770x515-2019-09-10T135137.593.jpg");
        urls.add("https://siteniagaweb.co.id/amanah-takaful/wp-content/uploads/2019/07/donasi-sekarang-1.png");
        urls.add("https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTVZNZ4xt26RhB7guvwLNStEtB3TYCGbZqYzl5B0bTGAE0g6biU&usqp=CAU");
        BaseBannerAdapter webBannerAdapter = new BaseBannerAdapter(getActivity().getApplicationContext(), urls);
        webBannerAdapter.setOnBannerItemClickListener(new BannerLayout.OnBannerItemClickListener() {
            @Override
            public void onItemClick(int position) {

            }
        });
            banner.setAdapter(webBannerAdapter);

        //String jenenge = getActivity().getIntent().getStringExtra("jeneng");
//        id_regis = getActivity().getIntent().getStringExtra("id_registrasi");
//        Log.e("id_register" ,""+ id_regis);
        String val = authdata.getInstance(getActivity()).getKodeUser();
        Log.e("val","testes" + val);
        //nama_user.setText(jenenge);
        loaddetail();
        retrieveJSON();

        return v;
    }

    private void retrieveJSON()
    {
        StringRequest stringRequest  = new StringRequest(Request.Method.GET, ServerApi.IPServer + "kasus/index_get", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Log.d("strrrrr", ">>" + response);
                try {
                    JSONObject obj  = new JSONObject(response);

                    modelDataList = new ArrayList<>();
                    JSONArray data = obj.getJSONArray("data");
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModelData playerModel = new ModelData();
                        JSONObject dataobj = data.getJSONObject(i);
                        playerModel.setJudul(dataobj.getString("judul"));
                        playerModel.setID_Kasus(dataobj.getString("id_kasus"));
                        playerModel.setTujuan(Util.setformatrupiah(dataobj.getString("tujuan_dana")));
                        playerModel.setImage(dataobj.getString("gambar"));
                        playerModel.setID_Panti(dataobj.getString("id_panti"));

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
        listAdapter = new ListAdapter(getContext(), modelDataList);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getActivity().getApplicationContext());
        rv.setLayoutManager(layoutManager);
        rv.setAdapter(listAdapter);

        listAdapter.setOnItemClickListenener(HomeFragment.this);

    }


    private void loaddetail()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "data_user/index_get?id_registrasi="+authdata.getInstance(getActivity()).getKodeUser(), new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    saldo.setText(Util.setformatrupiah(arr1.getString("finansial")));
                    nama_user.setText(arr1.getString("nama_user"));
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

//            @Override
//            public Map<String, String> getParams() throws AuthFailureError {
//                Map<String, String> params = new HashMap<String, String>();
//                params.put("id_registrasi", authdata.getInstance(getActivity()).getKodeUser());
//                return params;
//            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(getActivity().getApplicationContext());

        requestQueue.add(senddata);
    }

    @Override
    public void OnitemClick(int position) {
        Intent detailIntent = new Intent(getActivity().getApplicationContext(), DetailDonasiActivity.class);
        ModelData clickItem = modelDataList.get(position);

//        detailIntent.putExtra(EXTRA_IMG, clickItem.getImage());
        detailIntent.putExtra(EXTRA_ID, clickItem.getID_Kasus());
        detailIntent.putExtra(EXTRA_ID_PANTI, clickItem.getID_Panti());

        startActivity(detailIntent);

    }
}
