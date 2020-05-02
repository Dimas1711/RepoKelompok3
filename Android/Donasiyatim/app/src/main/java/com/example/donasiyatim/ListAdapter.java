package com.example.donasiyatim;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.donasiyatim.configfile.ServerApi;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

public class ListAdapter extends RecyclerView.Adapter<ListAdapter.ListViewHolder> {

    private ArrayList<ModelData> dataArrayList;

    public ListAdapter(ArrayList<ModelData> dataArrayList)
    {
        this.dataArrayList = dataArrayList;
    }



    @NonNull
    @Override
    public ListViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        LayoutInflater inflater = LayoutInflater.from(parent.getContext());
        View view = inflater.inflate(R.layout.list_item_kasus, parent,false);
        return new ListViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ListViewHolder holder, int position) {
        holder.judul.setText(dataArrayList.get(position).getJudul());
        holder.tujuan_dana.setText(dataArrayList.get(position).getTujuan());
        //Picasso.get().load(ServerApi.IPServer + dataArrayList.get(position)).into(holder.image);

    }

    @Override
    public int getItemCount() {
        return (dataArrayList != null) ? dataArrayList.size() : 0;
    }

    public class ListViewHolder extends RecyclerView.ViewHolder {
        private TextView judul,tujuan_dana;
        private ImageView image;
        public ListViewHolder(@NonNull View itemView) {
            super(itemView);
            judul = itemView.findViewById(R.id.tv_judul);
            tujuan_dana = itemView.findViewById(R.id.tv_tujuan_dana);
            image = itemView.findViewById(R.id.img_kasus);
        }
    }
}
