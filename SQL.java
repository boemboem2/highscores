package palidino76.rs2.io;

import java.sql.*;
import java.security.MessageDigest;
import java.util.*;
import java.lang.*;
import palidino76.rs2.Server;
import palidino76.rs2.Engine;
import palidino76.rs2.io.*;
import palidino76.rs2.player.Player;
import palidino76.rs2.util.Misc;

public class SQL {


	public static Connection con = null;
	public static Statement stmt;

	public static void createConnection() {
		try {
			Class.forName("com.mysql.jdbc.Driver").newInstance();
	    String IP="localhost";
            String DB="DATABASE";
            String User="root";
            String Pass="PASSWORD";
            con = DriverManager.getConnection("jdbc:mysql://"+IP+"/"+DB, User, Pass);
			stmt = con.createStatement();
			Misc.println("Connection to SQL database successful!");
		} catch (Exception e) {
		Misc.println("Connection to SQL database failed");
			e.printStackTrace();
		}
	}
	public static ResultSet query(String s) throws SQLException {
		try {
			if (s.toLowerCase().startsWith("select")) {
				ResultSet rs = stmt.executeQuery(s);
				Misc.println("Success");
				return rs;
			} else {
				stmt.executeUpdate(s);
			}
			return null;
		} catch (Exception e) {
			destroyConnection();
			createConnection();
			Misc.println("Failed");
			//e.printStackTrace();
		}
		return null;
	}

	public static void destroyConnection() {
		try {
			stmt.close();
			con.close();
			Misc.println("Destruction from SQL database successful");
		} catch (Exception e) {
		Misc.println("Destruction from SQL database successful");
			//e.printStackTrace();
		}
	}

	public static boolean saveHighScore(Player p) {
		try {
			query("DELETE FROM `skills` WHERE playerName = '"+p.username+"';");
			query("DELETE FROM `skillsoverall` WHERE playerName = '"+p.username+"';");
			query("INSERT INTO `skills` (`playerName`,`Attacklvl`,`Attackxp`,`Defencelvl`,`Defencexp`,`Strengthlvl`,`Strengthxp`,`Hitpointslvl`,`Hitpointsxp`,`Rangelvl`,`Rangexp`,`Prayerlvl`,`Prayerxp`,`Magiclvl`,`Magicxp`,`Cookinglvl`,`Cookingxp`,`Woodcuttinglvl`,`Woodcuttingxp`,`Fletchinglvl`,`Fletchingxp`,`Fishinglvl`,`Fishingxp`,`Firemakinglvl`,`Firemakingxp`,`Craftinglvl`,`Craftingxp`,`Smithinglvl`,`Smithingxp`,`Mininglvl`,`Miningxp`,`Herblorelvl`,`Herblorexp`,`Agilitylvl`,`Agilityxp`,`Thievinglvl`,`Thievingxp`,`Slayerlvl`,`Slayerxp`,`Farminglvl`,`Farmingxp`,`Runecraftlvl`,`Runecraftxp`,`Hunterlvl`,`Hunterxp`,`Constructionlvl`,`Constructionxp`,`Summoninglvl`,`Summoningxp`) VALUES ('"+p.username+"',"+p.skillLvl[0]+","+p.skillXP[0]+","+p.skillLvl[1]+","+p.skillXP[1]+","+p.skillLvl[2]+","+p.skillXP[2]+","+p.skillLvl[3]+","+p.skillXP[3]+","+p.skillLvl[4]+","+p.skillXP[4]+","+p.skillLvl[5]+","+p.skillXP[5]+","+p.skillLvl[6]+","+p.skillXP[6]+","+p.skillLvl[7]+","+p.skillXP[7]+","+p.skillLvl[8]+","+p.skillXP[8]+","+p.skillLvl[9]+","+p.skillXP[9]+","+p.skillLvl[10]+","+p.skillXP[10]+","+p.skillLvl[11]+","+p.skillXP[11]+","+p.skillLvl[12]+","+p.skillXP[12]+","+p.skillLvl[13]+","+p.skillXP[13]+","+p.skillLvl[14]+","+p.skillXP[14]+","+p.skillLvl[15]+","+p.skillXP[15]+","+p.skillLvl[16]+","+p.skillXP[16]+","+p.skillLvl[17]+","+p.skillXP[17]+","+p.skillLvl[18]+","+p.skillXP[18]+","+p.skillLvl[19]+","+p.skillXP[19]+","+p.skillLvl[20]+","+p.skillXP[20]+","+p.skillLvl[21]+","+p.skillXP[21]+","+p.skillLvl[22]+","+p.skillXP[22]+","+p.skillLvl[23]+","+p.skillXP[23]+");");
			query("INSERT INTO `skillsoverall` (`playerName`,`lvl`,`xp`) VALUES ('"+p.username+"',"+(p.skillLvl[0] + p.skillLvl[1] + p.skillLvl[2] + p.skillLvl[3] + p.skillLvl[4] + p.skillLvl[5] + p.skillLvl[6] + p.skillLvl[7] + p.skillLvl[8] + p.skillLvl[9] + p.skillLvl[10] + p.skillLvl[11] + p.skillLvl[12] + p.skillLvl[13] + p.skillLvl[14] + p.skillLvl[15] + p.skillLvl[16] + p.skillLvl[17] + p.skillLvl[18] + p.skillLvl[19] + p.skillLvl[20] + p.skillLvl[21] + p.skillLvl[22] + p.skillLvl[23])+","+((p.skillXP[0]) + (p.skillXP[1]) + (p.skillXP[2]) + (p.skillXP[3]) + (p.skillXP[4]) + (p.skillXP[5]) + (p.skillXP[6]) + (p.skillXP[7]) + (p.skillXP[8]) + (p.skillXP[9]) + (p.skillXP[10]) + (p.skillXP[11]) + (p.skillXP[12]) + (p.skillXP[13]) + (p.skillXP[14]) + (p.skillXP[15]) + (p.skillXP[16]) + (p.skillXP[17]) + (p.skillXP[18]) + (p.skillXP[19]) + (p.skillXP[20]) + (p.skillXP[21]) + (p.skillXP[22]) + (p.skillXP[23]))+");");
			Misc.println("Values inserted into SQL database");
		} catch (Exception e) {
		Misc.println("Values NOT inserted into SQL database");
			e.printStackTrace();
			return false;
		}
		return true;
	}
}