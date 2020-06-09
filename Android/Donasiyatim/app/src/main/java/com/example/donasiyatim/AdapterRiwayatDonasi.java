package com.example.donasiyatim;

import android.content.Context;
import android.content.Intent;
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

//        holder.itemView.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                Intent intent = new Intent(holder.itemView.getContext(), DetailDonasiActivity.class);
//                intent.putExtra("id_kasus", holder.id_kasus);
//                intent.putExtra("id_panti", holder.id_panti);
//                holder.itemView.getContext().startActivity(intent);
//            }
//        });

        holder.tgl.setText(me.getTanggal());
        holder.uang.setText(me.getJumlah_donasi());
         }

    @Override
    public int getItemCount() {
        return mItems.size();
    }

    public class HolderData extends RecyclerView.ViewHolder {
        TextView tgl , uang;
        public HolderData(@NonNull View itemView) {
            super(itemView);
            tgl = itemView.findViewById(R.id.tv_tanggal);
            uang = itemView.findViewById(R.id.tv_uang);
        }
    }

}

