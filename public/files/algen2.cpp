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
int tmp[100][100];

int fitness2[100];
double probability_roulette2[100];
int offspring[100][100];

//end of variable declaration

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

void cross_over_permutasi(int banyak_toko) //order crossover
{
    int tmp1[5][100];
    int batas1 = rand()%(banyak_toko-1);

    int batas2;
    do
    {
        batas2 = rand()%(banyak_toko-1);
    } while (batas2 == batas1);

    if (batas1 > batas2) swap(batas1, batas2);

    bool flag[100];
    memset(flag, false, sizeof flag);

    for (int i=batas1+1 ; i<=batas2 ; i++)
    {
        tmp1[0][i] = offspring[1][i];
        flag[ tmp1[0][i] ] = true;
    }

    int k=1;
    for (int i=1 ; i<=banyak_toko ; i++)
    {
        int t = batas2+i;
        t = t%banyak_toko;
        if (flag[ offspring[0][t] ] == false)
        {
            int tt=batas2+k;
            k++;
            tt = tt%banyak_toko;
            tmp1[0][tt] = offspring[0][t];
            flag[offspring[0][t]] = true;
        }
    }

    memset(flag, false, sizeof flag);

    for (int i=batas1+1 ; i<=batas2 ; i++)
    {
        tmp1[1][i] = offspring[0][i];
        flag[ tmp1[1][i] ] = true;
    }

    k=1;
    for (int i=1 ; i<=banyak_toko ; i++)
    {
        int t = batas2+i;
        t = t%banyak_toko;
        if (flag[ offspring[1][t] ] == false)
        {
            int tt=batas2+k;
            k++;
            tt = tt%banyak_toko;
            tmp1[1][tt] = offspring[1][t];
            flag[offspring[1][t]] = true;
        }
    }


    cout <<"---------------------------\n";
    cout << batas1 << " "<<batas2 << endl;
    for (int i=0 ; i<banyak_toko ; i++)
        cout << offspring[0][i];
    cout <<"\n";
    for (int i=0 ; i<banyak_toko ; i++)
        cout << offspring[1][i];
    cout <<"\n";
    for (int i=0 ; i<banyak_toko ; i++)
        cout << tmp1[0][i];
    cout <<"\n";
    for (int i=0 ; i<banyak_toko ; i++)
        cout << tmp1[1][i];
    cout <<"\n";

    for (int i=0 ; i<banyak_toko ; i++)
    {
        offspring[0][i] = tmp1[0][i];
        offspring[1][i] = tmp1[1][i];
    }
}

void mutasi_permutasi(int banyak_toko)
{
    int acak;
    do
    {
        acak = rand() % (2*banyak_toko);
    } while (acak == banyak_toko-1 || acak == 2*banyak_toko-1);

    if (acak >= banyak_toko)
    {
        acak = acak - banyak_toko;
        swap(offspring[1][acak], offspring[1][acak+1]);
    }
    else
    {
        swap(offspring[0][acak], offspring[0][acak+1]);
    }
}

int offspring_cost(int index_populasi, int index, int banyak_toko)
{
    int total = 100 * banyak_toko;
    total += dist[ 0 ][ offspring[index][0] ];
    total += dist[ 0 ][ offspring[index][banyak_toko-1] ];

    for (int i=1 ; i<banyak_toko ; i++)
    {
        total += dist[ offspring[index][i] ][ offspring[index][i-1] ];
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

void hitung_susunan_terbaik_permutasi(int jj, int banyak_toko)
{
    //generate populasi awal
    for (int k=0 ; k<jumlah_populasi ;)
    {
        for (int kolom=0 ; kolom<banyak_toko ; kolom++)
        {
            populasi_permutasi[k][kolom] = urutan_kota_yang_dikunjungi[jj][kolom];
        }

        int acak = rand()%factorial(banyak_toko);
        int t=-1;
        do{
            t++;
        } while (t<acak && next_permutation(populasi_permutasi[k], populasi_permutasi[k]+banyak_toko));

        int cost = hitung_total(jj,k,banyak_toko);
        if (cost <= 1280)
        {
            fitness2[k] = 1280 - cost;
            k++;
        }
    }

    int total_fitness2 = 0;
    for (int i=0 ; i<jumlah_populasi ; i++)
    {
        total_fitness2 += fitness2[i];
    }

    for (int i=0 ; i<jumlah_populasi ; i++)
    {
        if (i==0)
        {
            probability_roulette2[i] = (double) fitness2[i] / total_fitness2;
        }
        else
        {
            probability_roulette2[i] = probability_roulette2[i-1] + (double) fitness2[i] / total_fitness2;
        }
    }
    printf("individu biner ke-%d , ", jj);
    cout << "Generasi ke-0 permutasi :\n";
    for (int i=0 ; i<jumlah_populasi ; i++)
    {
        for (int j=0 ; j<banyak_toko ; j++)
        {
            printf("%d", populasi_permutasi[i][j]);
        }
        printf(" : %d dan %.4lf\n", fitness2[i], probability_roulette2[i]);
    }
    //generate populasi awal selesai

    //mulai peng-algen-an
    //dipilih 2 individu secara acak, terus dikawinkan dengan cara order crossover
    for (int i=0 ; i<jumlah_iterasi ; i++)
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
            while (!(probability_roulette2[index] > roulette && probability_roulette2[index-1] < roulette))
                index--;

            if (flag[index] == false)
            {
                //cout << roulette << endl;
                flag[index] = true;
                index_untuk_crossover[tt] = index;
                tt++;
                j++;
            }
            //cout << acak << endl;
        }

        for (int j=0 ; j<banyak_toko ; j++)
        {
            offspring[0][j] = populasi_permutasi[ index_untuk_crossover[0] ][j];
        }
        for (int j=0 ; j<banyak_toko ; j++)
        {
            offspring[1][j] = populasi_permutasi[ index_untuk_crossover[1] ][j];
        }

        cross_over_permutasi(banyak_toko);
        mutasi_permutasi(banyak_toko);

        for (int j=0 ; j<banyak_toko ; j++)
            printf("%d", offspring[0][j]);
        puts("");
        for (int j=0 ; j<banyak_toko ; j++)
            printf("%d", offspring[1][j]);
        puts("");

        int jumlah_sekarang = jumlah_populasi;
        for (int j=0 ; j<2 ; j++)
        {
            int cost = offspring_cost(jj, j, banyak_toko);


            printf("offspring %d fitnessnya %d\n", j, 1280-cost);
            fitness2[jumlah_populasi+j] = 1280-cost;
            for (int k=0 ; k<banyak_toko ; k++)
            {
                populasi_permutasi[jumlah_populasi+j][k] = offspring[j][k];
            }
            jumlah_sekarang++;
        }

        for (int j=0 ; j<jumlah_populasi+2 ; j++) cout << fitness2[j]<<endl;

        ii pasangan_index_fitness[100];
        for (int j=0 ; j<jumlah_populasi+2 ; j++)
        {
            pasangan_index_fitness[j] = ii( fitness2[j], j );
        }

        sort(pasangan_index_fitness, pasangan_index_fitness+(jumlah_populasi+2));
        //for (int j=0 ; j<jumlah_populasi+2 ; j++) printf("%d %d\n", j, fitness2[j]);
        int index1 = pasangan_index_fitness[0].second, index2 = pasangan_index_fitness[1].second;
        printf("index1 : %d , index2 : %d\n", index1, index2);
        tt = 0;
        for (int j=0 ; j<jumlah_populasi+2 ; j++)
        {
            if (j!=index1 && j!=index2)
            {
                for (int k=0 ; k<banyak_toko ; k++)
                {
                    tmp[tt][k] = populasi_permutasi[j][k];
                }
                tt++;
            }
        }

        for (int j=0 ; j<jumlah_populasi ; j++)
        {
            for (int k=0 ; k<banyak_toko ; k++)
            {
                populasi_permutasi[j][k] = tmp[j][k];
            }

        }

        total_fitness2 = 0;
        for (int j=0 ; j<jumlah_populasi ; j++)
        {
            fitness2[j] = 1280 - hitung_total(jj,j,banyak_toko);
            total_fitness2 += fitness2[j];
        }

        for (int j=0 ; j<jumlah_populasi ; j++)
        {
            if (j==0)
            {
                probability_roulette2[j] = (double) fitness2[j] / total_fitness2;
            }
            else
            {
                probability_roulette2[j] = probability_roulette2[j-1] + (double) fitness2[j] / total_fitness2;
            }
        }
        printf("Individu biner ke %d, generasi ke-%d permutasi :\n",jj, i+1);
        for (int j=0 ; j<jumlah_populasi ; j++)
        {
            for (int kk=0 ; kk<banyak_toko ; kk++)
            {
                printf("%d", populasi_permutasi[j][kk]);
            }
            printf(" : %d dan %.4lf\n", fitness2[j], probability_roulette2[j]);
        }
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
    if (banyak_toko<5)
    {
        for (int kolom=0 ; kolom<banyak_toko ; kolom++)
        {
            populasi_permutasi[j][kolom] = urutan_kota_yang_dikunjungi[j][kolom];
        }
        do{
            fitness_sementara = max(fitness_sementara, 1280 - hitung_total(j,j,banyak_toko));
        } while ( next_permutation(populasi_permutasi[j] , populasi_permutasi[j]+banyak_toko) );
        /*for (int k=0 ; k<50 ; k++)
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
        }*/
    }
    else
    {
        hitung_susunan_terbaik_permutasi(j, banyak_toko);
        for (int i=0 ; i<jumlah_populasi ; i++)
        {
            fitness_sementara = max(fitness_sementara, fitness2[i]);
        }
    }

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
    for (int j=0 ; j<jumlah_populasi ; j++){
        for (int i=1 ; i<=8 ; i++)
        {
            printf("%3d", kota_yang_dikunjungi[j][i]);
        }
        puts("");
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

    cout <<"Generasi ke-0:\n";
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
