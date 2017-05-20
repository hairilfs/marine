#include <bits/stdc++.h>

using namespace std;

#define x first
#define y second
typedef vector<int> vi;
typedef vector<bool> vb;
typedef pair<int, int> ii;
typedef vector<ii> vii;

//toko 0 = rumah
int dist[100][100] = {
    {0,30,20,40,25,30,20,45,30},
    {30,0,10,25,30,25,45,25,40},
    {20,10,0,30,20,35,25,15,30},
    {40,25,30,0,35,15,20,30,20},
    {25,30,20,35,0,15,10,30,20},
    {30,25,35,15,15,0,40,25,30},
    {20,45,25,20,10,40,0,30,20},
    {45,25,15,30,30,25,30,0,15},
    {30,40,30,20,20,30,20,15,0}
};
int harga_per_disc_toko = 100;

int harga_per_disc_online[] = {0,150,150,200,180,140,135,170,155};

int jumlah_iterasi, jumlah_populasi;

bool kota_yang_dikunjungi[100][100];
int urutan_kota_yang_dikunjungi[100][100];
int populasi_permutasi[100][100];
int populasi_biner[100][100];
int fitness[100];
double probability_roulette[100];
bool tmp[100][100];

int hitung_total(int index_populasi, int index, int banyak_toko)
{
    int total = 100 * banyak_toko;
    int banyak_toko_online = 8-banyak_toko;
    total += dist[0][ populasi_permutasi[index][0] ];
    total += dist[0][ populasi_permutasi[index][banyak_toko-1] ];
    for (int i=1 ; i<banyak_toko ; i++)
    {
        total += dist[ populasi_permutasi[index][i-1] ][ populasi_permutasi[index][i] ];
    }
    for (int i=1 ; i<=8 ; i++)
    {
        if (kota_yang_dikunjungi[index_populasi][i] == 0)
        {
            total += harga_per_disc_online[i];
        }
    }
    return total;
}

int factorial(int n)
{
    return n==0 ? 1 : n*factorial(n-1);
}

void cross_over_biner(int index_1, int index_2)
{
    int batas = 2;
    for (int i=1 ; i<=8 ; i++)
    {
        if (i<=batas)
        {
            kota_yang_dikunjungi[jumlah_populasi][i] = kota_yang_dikunjungi[index_1][i];
            kota_yang_dikunjungi[jumlah_populasi+1][i] = kota_yang_dikunjungi[index_2][i];
        }
        else
        {
            kota_yang_dikunjungi[jumlah_populasi][i] = kota_yang_dikunjungi[index_2][i];
            kota_yang_dikunjungi[jumlah_populasi+1][i] = kota_yang_dikunjungi[index_1][i];
        }
    }
}

void mutasi_biner()
{
    int acak1 = rand()%16;
    acak1++;
    if (acak1 > 8)
    {
        acak1 = acak1 - 8;
        kota_yang_dikunjungi[jumlah_populasi+1][acak1] = !kota_yang_dikunjungi[jumlah_populasi+1][acak1];
    }
    else
    {
        kota_yang_dikunjungi[jumlah_populasi][acak1] = !kota_yang_dikunjungi[jumlah_populasi][acak1];
    }

    int acak2 = rand()%16;
    acak2++;
    if (acak2 > 8)
    {
        acak2 = acak2 - 8;
        kota_yang_dikunjungi[jumlah_populasi+1][acak2] = !kota_yang_dikunjungi[jumlah_populasi+1][acak2];
    }
    else
    {
        kota_yang_dikunjungi[jumlah_populasi][acak2] = !kota_yang_dikunjungi[jumlah_populasi][acak2];
    }
}

int hitung_susunan_terbaik(int j)
{
    int banyak_toko = 0;
    while (urutan_kota_yang_dikunjungi[j][banyak_toko] != 0)
    {
        banyak_toko++;
    }
    //printf("individu ke-%d banyak toko yang dikunjungi %d\n", j, banyak_toko);
    //int f = hitung_total(j, banyak_toko);
    //cout << f << endl;
    int fitness_sementara = 0;
    for (int k=0 ; k<100 ; k++)
    {
        for (int kolom=0 ; kolom<banyak_toko ; kolom++)
        {
            populasi_permutasi[k][kolom] = urutan_kota_yang_dikunjungi[j][kolom];
        }
        int acak = rand()%factorial(banyak_toko);
        int t=-1;
        do{
            t++;
        } while (t<acak && next_permutation(populasi_permutasi[k], populasi_permutasi[k]+banyak_toko));
        //cout << acak << endl;
        //for (int tt=0 ; tt<banyak_toko ; tt++) printf("%4d", populasi_permutasi[k][tt]);
        int cost = hitung_total(j, k, banyak_toko);
        //printf(" : %d\n", cost);
        if (cost <= 1280)
        {
            fitness_sementara = max(fitness_sementara, 1280 - cost);
        }
    }
    //cout << fitness_sementara << endl;
    return fitness_sementara;
}

int main()
{

    srand(time(NULL));
    printf("Masukkan jumlah populasi : "); cin >> jumlah_populasi;
    printf("Masukkan jumlah iterasi : "); cin >> jumlah_iterasi;

    for (int j=0 ; j<jumlah_populasi ; j++)
    {
        int index = 0;
        for (int k=1 ; k<=8 ; k++)
        {
            int acak = rand();
            if (acak%2 == 0) kota_yang_dikunjungi[j][k] = false;
            else
            {
                kota_yang_dikunjungi[j][k] = true;
                urutan_kota_yang_dikunjungi[j][index] = k;
                index++;
            }
        }
    }



    int total_fitness = 0;
    for (int j=0 ; j<jumlah_populasi ; j++)
    {
        fitness[j] = hitung_susunan_terbaik(j);
        total_fitness += fitness[j];
    }

    for (int j=0 ; j<jumlah_populasi ; j++)
    {
        double tt = (double) fitness[j] / total_fitness;
        if (j==0) probability_roulette[j] = tt;
        else probability_roulette[j] = probability_roulette[j-1]+tt;
    }
    cout << "Generasi ke-0:\n";
    for (int j=0 ; j<jumlah_populasi ; j++)
    {
        for (int k=1 ; k<=8 ; k++) printf("%d", kota_yang_dikunjungi[j][k]);
        printf(" : ");
        int tt = 0;
        do
        {
            printf("%2d", urutan_kota_yang_dikunjungi[j][tt++]);
        } while (urutan_kota_yang_dikunjungi[j][tt] != 0);
        printf(" , fitness : %d\n", fitness[j]);
    }

    for (int i=1 ; i<=jumlah_iterasi ; i++)
    {

        bool flag[100];
        memset(flag, false, sizeof flag);
        int index_untuk_crossover[100];
        int tt = 0;
        for (int j=0 ; j<2 ;)
        {
            int acak = rand() % (1<<8);
            if (acak == 0) acak = 1;
            if (acak == 1<<8) acak -= 1;
            double roulette = (double) acak/(1<<8);

            int index = jumlah_populasi-1;
            while (!(probability_roulette[index] > roulette && probability_roulette[index-1] < roulette))
                index--;

            if (flag[index] == false)
            {
                flag[index] = true;
                index_untuk_crossover[tt] = index;
                tt++;
                j++;
            }
            //cout << acak << endl;
        }

        //for (int j=0 ; j<2 ; j++) cout << index_untuk_crossover[j]<<endl;

        cross_over_biner(index_untuk_crossover[0], index_untuk_crossover[1]);
        mutasi_biner();

        for (int j=0 ; j<jumlah_populasi+2 ; j++)
        {
            int index = 0;
            for (int k=1 ; k<=8 ; k++)
            {
                if (kota_yang_dikunjungi[j][k] == true)
                {
                    urutan_kota_yang_dikunjungi[j][index] = k;
                    index++;
                }
            }
        }

        fitness[jumlah_populasi] = hitung_susunan_terbaik(jumlah_populasi);
        fitness[jumlah_populasi+1] = hitung_susunan_terbaik(jumlah_populasi+1);

        /*for (int j=0 ; j<jumlah_populasi+2 ; j++)
        {
            printf("Individu ke %d , fitness-nya %d\n", j,fitness[j]);
        }*/

        ii pasangan_index_fitness[100];
        for (int j=0 ; j<jumlah_populasi+2 ; j++)
        {
            pasangan_index_fitness[j] = ii( fitness[j], j );
        }
        sort(pasangan_index_fitness, pasangan_index_fitness+jumlah_populasi+2);
        int index1 = pasangan_index_fitness[0].second, index2 = pasangan_index_fitness[1].second;

        tt = 0;
        for (int j=0 ; j<jumlah_populasi+2 ; j++)
        {
            if (j!=index1 && j!=index2)
            {
                for (int k=1 ; k<=8 ; k++)
                {
                    tmp[tt][k] = kota_yang_dikunjungi[j][k];
                }
                tt++;
            }
        }

        for (int j=0 ; j<jumlah_populasi ; j++)
        {
            for (int k=1 ; k<=8 ; k++)
            {
                kota_yang_dikunjungi[j][k] = tmp[j][k];
            }
        }

        memset(urutan_kota_yang_dikunjungi, 0, sizeof urutan_kota_yang_dikunjungi);
        for (int j=0 ; j<jumlah_populasi ; j++)
        {
            int index = 0;
            for (int k=1 ; k<=8 ; k++)
            {
                if (kota_yang_dikunjungi[j][k] == true)
                {
                    urutan_kota_yang_dikunjungi[j][index] = k;
                    index++;
                }
            }
        }

        total_fitness = 0;
        for (int j=0 ; j<jumlah_populasi ; j++)
        {
            fitness[j] = hitung_susunan_terbaik(j);
            total_fitness += fitness[j];
        }

        for (int j=0 ; j<jumlah_populasi ; j++)
        {
            double tt = (double) fitness[j] / total_fitness;
            if (j==0) probability_roulette[j] = tt;
            else probability_roulette[j] = probability_roulette[j-1]+tt;
        }

        printf("Generasi ke-%d:\n", i);
        for (int j=0 ; j<jumlah_populasi ; j++)
        {
            for (int k=1 ; k<=8 ; k++) printf("%d", kota_yang_dikunjungi[j][k]);
            printf(" : ");
            int tt = 0;
            do
            {
                printf("%2d", urutan_kota_yang_dikunjungi[j][tt++]);
            } while (urutan_kota_yang_dikunjungi[j][tt] != 0);
            printf(" , fitness : %d\n", fitness[j]);
        }

    }
}
