using System;
using System.Threading;

class Program
{
    static void Main()
    {
        Console.CursorVisible = false;
        Console.ForegroundColor = ConsoleColor.Red;

        string[] boom =
        {
            "        *        ",
            "       ***       ",
            "      *****      ",
            "   ***********   ",
            "*****************",
            "   ***********   ",
            "      *****      ",
            "       ***       ",
            "        *        "
        };

        for (int round = 0; round < 8; round++)
        {
            Console.Clear();

            Console.ForegroundColor =
                (ConsoleColor)(round % 2 == 0
                    ? ConsoleColor.Red
                    : ConsoleColor.Yellow);

            foreach (string line in boom)
            {
                Console.WriteLine(line);
                Thread.Sleep(40);
            }

            Console.Clear();

            Console.ForegroundColor = ConsoleColor.White;
            Console.WriteLine("\n\n\n");
            Console.WriteLine("        💥  B O O O O M !  💥");

            Thread.Sleep(180);
        }

        Console.ForegroundColor = ConsoleColor.Cyan;
        Console.WriteLine("\n\n     SYSTEM OVERLOAD!!!");
        Console.WriteLine("     Just kidding 😎");
        Console.CursorVisible = true;
    }
}