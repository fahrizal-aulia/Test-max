<script>

// function fibonacci(n) {
//   if (n <= 1) {
//     return n;
//   }
//   return fibonacci(n - 1) + fibonacci(n - 2);
// }


// function tampilkanDeretFibonacci(jumlahAngka) {
//   console.log(`Menampilkan ${jumlahAngka} angka pertama dari deret Fibonacci:`);

//   let deret = [];

//   for (let i = 0; i < jumlahAngka; i++) {
//     deret.push(fibonacci(i));
//   }

//   console.log(deret.join(", "));
// }


// tampilkanDeretFibonacci(5);
// ------------------------------------------
let nilai = [5, 3, 8, 1, 2];

function urutkanmanual(arr) {
    for (let i = 0; i < arr.length - 1; i++) {
        console.log("Iterasi ke-" + (i + 1));
        for (let j = 0; j < arr.length - i - 1; j++) {
            if (arr[j] < arr[j + 1]) {
                let temp = arr[j];
                arr[j] = arr[j + 1];
                arr[j + 1] = temp;
            }
        }
    }
    return arr;
}

let hasilUrut = urutkanmanual(nilai);
console.log("Nilai setelah diurutkan: [" + hasilUrut.join(", ") + "]");

// ------------------------------------------

// function cariTerbesar(listAngka) {
//   let panjang = listAngka.length;

//   if (panjang === 0) {
//     return null;
//   }

//   let terbesarSementara = listAngka[0];

//   for (let i = 1; i < panjang; i++) {

//     let angkaSekarang = listAngka[i];

//     if (angkaSekarang > terbesarSementara) {

//       terbesarSementara = angkaSekarang;
//     }
//   }
//   return terbesarSementara;
// }


// function cariTerkecil(listAngka) {
//   let panjang = listAngka.length;

//   if (panjang === 0) {
//     return null;
//   }

//   let terkecilSementara = listAngka[0];

//   for (let i = 1; i < panjang; i++) {

//     let angkaSekarang = listAngka[i];

//     if (angkaSekarang < terkecilSementara && angkaSekarang >=0) {
//         terkecilSementara = angkaSekarang;
//     }
//   }

//   return terkecilSementara;
// }


// let daftarNilai = [3,7,-3,5,9,5];
// console.log(`List: [${daftarNilai}]`);

// let terbesar = cariTerbesar(daftarNilai);
// console.log(`Angka TERBESAR adalah: ${terbesar}`);

// // let daftarNilaikecil = [3,7,-3,5,9,5];
// // console.log(`List: [${daftarNilaikecil}]`);

// let terkecil = cariTerkecil(daftarNilai);
// console.log(`Angka TERKECIL adalah: ${terkecil}`);





// ------------------------------------------
// Fungsi untuk menghitung umur dan tahun kabisat terlewati
// function calculateAge(birthDateStr) {
//     const birthDate = new Date(birthDateStr);
//     const today = new Date();

//     let years = today.getFullYear() - birthDate.getFullYear();
//     let months = today.getMonth() - birthDate.getMonth();
//     let days = today.getDate() - birthDate.getDate();

//     if (days < 0) {
//         months--;
//         days += new Date(today.getFullYear(), today.getMonth(), 0).getDate();
//     }

//     if (months < 0) {
//         years--;
//         months += 12;
//     }

//     // Hitung tahun kabisat
//     let leapYears = 0;
//     let tahunkabisat = [];
//     for (let year = birthDate.getFullYear(); year <= today.getFullYear(); year++) {
//         if ((year % 4 === 0 && year % 100 !== 0) || year % 400 === 0) {
//             leapYears++;
//             tahunkabisat.push(year);
//             console.log("Tahun kabisat: " + year);
//         }
//     }

//     return {
//         tahunkabisat(slice(0, -1).join(", ")),
//         // age: `${years} tahun, ${months} bulan, ${days} hari`,
//         // leapYears,
//         // th:tahunkabisat

//     };
// }

// // Contoh penggunaan
// console.log(calculateAge('1990-12-08')); //





// ---------------------------



</script>