package com.example.donasiyatim;

import android.content.Context;
import android.content.Intent;
import android.text.Layout;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.donasiyatim.configfile.ServerApi;
import com.squareup.picasso.Picasso;

import java.util.List;

public class ListAdapterRiwayatTopup extends RecyclerView.Adapter<ListAdapterRiwayatTopup.HolderDataRiwayatTopup> {
    private List<ModelDataRiwayatTopup> mItems;
    private Context context;

    public ListAdapterRiwayatTopup(Context context, List<ModelDataRiwayatTopup> modelDataRiwayatTopup)
    {
        this.context = context;
        this.mItems = modelDataRiwayatTopup;
    }
    @NonNull
    @Override
    public HolderDataRiwayatTopup onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_item_topup, parent, false);
        ListAdapterRiwayatTopup.HolderDataRiwayatTopup holderDataRiwayatTopup = new ListAdapterRiwayatTopup.HolderDataRiwayatTopup(layout);
        return holderDataRiwayatTopup;
    }

    @Override
    public void onBindViewHolder(@NonNull final HolderDataRiwayatTopup holder, int position) {
        ModelDataRiwayatTopup me = mItems.get(position);
        holder.uang.setText(me.getJumlah_uang());
        holder.tanggal.setText(me.getTanggal_topup());
    }

    @Override
    public int getItemCount() {
        return mItems.size();
    }

    public class HolderDataRiwayatTopup extends RecyclerView.ViewHolder {
        TextView uang,tanggal;
        public HolderDataRiwayatTopup(@NonNull View itemView) {
            super(itemView);
            uang = itemView.findViewById(R.id.tv_uang);
            tanggal = itemView.findViewById(R.id.tv_tanggal);

        }
    }
}
