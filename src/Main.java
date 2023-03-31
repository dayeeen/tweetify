import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner in = new Scanner(System.in);
        User u1 = new User();
        System.out.print("Username: ");
        u1.setUsername(in.nextLine());
        System.out.println("Selamat datang " + u1.getUsername());
        u1.post();
        u1.text(in.nextLine());
        u1.display();
        
    }
}
