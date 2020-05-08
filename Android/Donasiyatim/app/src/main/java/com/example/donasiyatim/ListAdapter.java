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

import java.util.ArrayList;
import java.util.List;

public class ListAdapter extends RecyclerView.Adapter<ListAdapter.HolderData> {
    private List<ModelData> mItems;
    private Context context;
//    private OnItemClickListener mListener;
//
//    public interface OnItemClickListener
//    {
//        void OnitemClick(int position);
//    }
//
//    public void setOnItemClickListenener(OnItemClickListener listenener)
//    {
//        mListener = listenener;
//    }

    public ListAdapter(Context context, List<ModelData> modelDataList)
    {
        this.context = context;
        this.mItems = modelDataList;
    }
    @NonNull
    @Override
    public HolderData onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
       View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_item_kasus, parent,false);
       ListAdapter.HolderData holderData = new ListAdapter.HolderData(layout);
       return holderData;
    }

    @Override
    public void onBindViewHolder(@NonNull final HolderData holder, int position) {
        ModelData me = mItems.get(position);

        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(holder.itemView.getContext(), DetailDonasiActivity.class);
                intent.putExtra("id_kasus", holder.id_kasus);
                intent.putExtra("id_panti", holder.id_panti);
                holder.itemView.getContext().startActivity(intent);
            }
        });

        holder.judul.setText(me.getJudul());
        holder.tujuan_dana.setText(me.getTujuan());
        holder.id_kasus = me.getID_Kasus();
        holder.id_panti = me.getID_Panti();
        Picasso.get().load(ServerApi.IPServer + "../" + "uploads/panti/" + me.getImage()).into(holder.image);
    }

    @Override
    public int getItemCount() {
        return mItems.size();
    }

    public class HolderData extends RecyclerView.ViewHolder {
        TextView judul,tujuan_dana;
        ImageView image;
        String id_kasus, id_panti;
        public HolderData(@NonNull View itemView) {
            super(itemView);
            judul = itemView.findViewById(R.id.tv_judul);
            tujuan_dana = itemView.findViewById(R.id.tv_tujuan_dana);
            image = itemView.findViewById(R.id.img_kasus);

//            itemView.setOnClickListener(new View.OnClickListener() {
//                @Override
//                public void onClick(View view) {
//                    if (mListener != null)
//                    {
//                        int position = getAdapterPosition();
//                        if (position != RecyclerView.NO_POSITION)
//                        {
//                            mListener.OnitemClick(position);
//                        }
//                    }
//                }
//            });
        }
    }

}
