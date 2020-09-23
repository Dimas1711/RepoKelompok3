package com.example.donasiyatim.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.donasiyatim.model.ModelRiwayatDonasi;
import com.example.donasiyatim.R;

import java.util.List;

public class AdapterRiwayatDonasi extends RecyclerView.Adapter<AdapterRiwayatDonasi.HolderData> {
    private List<ModelRiwayatDonasi> mItems;
    private Context context;


    public AdapterRiwayatDonasi(Context context, List<ModelRiwayatDonasi> modelDataList)
    {
        this.context = context;
        this.mItems = modelDataList;
    }
    @NonNull
    @Override
    public HolderData onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_donasi, parent,false);
        AdapterRiwayatDonasi.HolderData holderData = new AdapterRiwayatDonasi.HolderData(layout);
        return holderData;
    }

    @Override
    public void onBindViewHolder(@NonNull final HolderData holder, int position) {
        ModelRiwayatDonasi me = mItems.get(position);
        holder.tgl.setText(me.getTanggal());
        holder.uang.setText(me.getJumlah_donasi());
        holder.judul.setText(me.getJudul());
         }

    @Override
    public int getItemCount() {
        return mItems.size();
    }

    public class HolderData extends RecyclerView.ViewHolder {
        TextView tgl , uang, judul;
        public HolderData(@NonNull View itemView) {
            super(itemView);
            tgl = itemView.findViewById(R.id.tv_tanggal);
            uang = itemView.findViewById(R.id.tv_uang);
            judul = itemView.findViewById(R.id.tv);
        }
    }

}

