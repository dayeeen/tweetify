import java.io.*;
import java.lang.Thread;
import java.util.*;


public class User {
    private String username;
    int flwg;
    int folls;
    String tweet;

    void setUsername(String username) {
        this.username = username;
    }
    String getUsername() {
        return this.username;
    }

    void post() {
        //cornerbox
        System.out.println("┌──────────────────────────────────────────────────────");
        System.out.println("│ " + "Apa yang anda pikirkan? ");
        System.out.print("│ ");
    }
    void filter() {
        //filter postingan disini
        //filter String yang mengandung kata kasar
        //Ambil sample datanya dari file csv
        //import data file
        String fileName = "../data/bad-words.csv";
        //String line memecah tweet menjadi array
        //split regex
        String line = this.tweet;
        String[] marks = {",", ".", "!", "?", ";", ":", " "};
        String[] words = line.split("[" + String.join("", marks) + "]+");

        //badWords array
        String[] badWords = new String[2000];
        int i = 0;
        try {
            FileReader fr = new FileReader(fileName);
            BufferedReader br = new BufferedReader(fr);
            while((line = br.readLine()) != null) {
                badWords[i] = line;
                i++;
            }
            br.close();
        }
        catch(FileNotFoundException ex) {
            System.out.println("Unable to open file '" + fileName + "'");
        }
        catch(IOException ex) {
            System.out.println("Error reading file '" + fileName + "'");
        }
        //jika words ada di badWords
        //maka report
        for (int j = 0; j < words.length; j++) {
            for (int k = 0; k < badWords.length; k++) {
                if (words[j].equals(badWords[k])) {
                    this.report();
                    //exit
                    System.exit(0);
                }
            }
        }
    }
    void text(String text) {
        this.tweet = text;
        //call method upload
        this.upload();
    }
    void upload() {
        String s = "█";
        String load = "";
        //cornerbox
        System.out.println("┌──────────────────────────────────────────────────────");
        System.out.println("│ Mengunggah...");
        try {
            for (int i = 0; i < 7; i++) {
               
                // it will sleep the main thread for 1 sec
                // each time the for loop runs
                Thread.sleep(200);
                if (i == 0) {
                    System.out.print("│ ");
                }
                // printing the value of the variable
                load += s;             
                System.out.print(load);
            }
            System.out.println("\n└──────────────────────────────────────────────────────");
        }
        catch (Exception e) {
           
            // catching the exception
            System.out.println(e);
        }
        this.filter();
        //cornerbox
        System.out.println("│ Postingan anda berhasil diunggah.");
        System.out.println("└──────────────────────────────────────────────────────");
    }
    
    void report() {
        System.out.println("│ tweet anda melanggar syarat dan ketentuan komunitas.");
        System.out.println("│ Akun anda akan dibekukan selama 7 hari.");
        System.out.println("└──────────────────────────────────────────────────────");
    }
    
    void Num() {
        //random number
        Random rand = new Random();
        int likes = rand.nextInt(2000);
        int comments = rand.nextInt(1000);
        int share = rand.nextInt(500);
        int insights = rand.nextInt(5000);
        System.out.println("│ " + likes + " likes, " + comments + " comments, " + share + " shares, " + insights + " dilihat");
    }

    //2 params, uname and post
    void display() {
        //make a corner box with uname inside it
        System.out.println("┌──────────────────────────────────────────────────────");
        System.out.println("│ " + this.username);
        //display post
        System.out.print("│ \"" + this.tweet + "\"\n");
        //display likes, comments, shares
        this.Num();
        System.out.println("└──────────────────────────────────────────────────────");
    }
}