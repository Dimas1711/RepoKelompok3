package com.example.donasiyatim.configfile;

public class ServerApi {
   //public static final String IPServer="http://192.168.1.7/RepoKelompok3/Project/api/";
  // public static final String IPServer="http://10.0.2.2/modalin/";
  //public static final String IPServer="http://192.168.1.4/modalin/";
//    public static final String IPServer="http://192.168.137.1/modalin/";
   public static final String IPServer="http://192.168.43.173/RepoKelompok3/Project/api/";
    public static final String URL_LOGIN=IPServer+"auth/index_post";
    public static final String URL_LOGOUT=IPServer+"Api/authlogout";
    public static final String URL_SAVE_DATA=IPServer+"Api/savedata";
    public static final String URL_GET_DATA=IPServer+"Api/getdataresult";
    public static final String URL_GET_DETAIL_DATA=IPServer+"Api/getdetaildata";
    public static final String URL_LIST_ITEM = IPServer+"kasus/index_get";
    public static final String URL_DONASI = IPServer+"donasi/index_post";

}
