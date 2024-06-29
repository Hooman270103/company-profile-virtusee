@extends('layouts.frontend.app')


@section('content')

@include('layouts.frontend.components.navbar')

<section class="terms-and-service-body">
  <div class="container">
      {{-- <p class="uppercase">Last updated: 28 March 2023</p> --}}
      <h1>Kebijakan Privasi</h1>
      <p>Kebijakan privasi ini akan memberitahu bagaimana cara PT Virtusee Peta Sukses mengelola dan menjaga data yang dimiliki oleh customer layanan Virtusee.</p>
      <div class="terms-and-service-inner">
          <div class="row main-content" data-spy="scroll" data-target="#list-example" data-offset="20">
              <div class="col-md-4 sidebar">
                  <div class="terms-and-service-sidebar sidebar__inner" id="list-example">
                      <h6 class="content-table-title dm-sans"><img
                              src="{{ asset('assets_frontend') }}/images/auth-and-utility/textalign-left.svg" alt="icon"> DAFTAR ISI</h6>
                      <ol>
                          <li><a href="#one" class="list-group-item list-group-item-action">Definisi</a></li>
                          <li><a href="#two" class="list-group-item list-group-item-action">Pengelolaan Data</a></li>
                          <li><a href="#three" class="list-group-item list-group-item-action">Akses Situs</a></li>
                          <li><a href="#four" class="list-group-item list-group-item-action">Portal Web</a></li>
                          <li><a href="#five" class="list-group-item list-group-item-action">Mobile Apps</a></li>
                          <li><a href="#six" class="list-group-item list-group-item-action">Penggunaan Cookies</a></li>
                          <li><a href="#sevven" class="list-group-item list-group-item-action">Ketentuan Lain-lain</a></li>
                      </ol>
                  </div>
              </div>
          
              <div class="col-md-8">
                  <div 
                  class="terms-and-service-content scrollspy-example"
                  data-bs-spy="scroll"
                  data-bs-target="#list-example"
                  data-bs-offset="0"
                  tabindex="0"
                  >
                      <div id="one">
                          <h4>1. Definisi</h4>
                          <ol>
                            <li>
                              Virtusee adalah aplikasi berbasis web dan android untuk memantau kinerja tim lapangan customer PT. Virtusee Peta Sukses dilengkapi dengan teknologi GPS dan custom form, terdiri dari:
                                <ol>
                                    <li>Portal website merupakan portal website Virtusee yang dapat diakses melalui  <span class="text-decoration-underline text-primary" >http://virtusee.com/</span></li>
                                    <li>Mobile apps merupakan aplikasi Virtusee berbasis android yang dapat diunduh pada Play Store</li>
                                </ol>
                            </li>
                            <li>
                              Customer merupakan bagian yang terdiri namun tidak terbatas pada admin dan user pada layanan Virtusee.
                            </li>
                            <li>
                              User merupakan pengguna layanan mobile apps Virtusee.
                            </li>
                            <li>
                              Informasi Pribadi merupakan informasi mengenai customer yang dapat diidentifikasi dan dikumpulkan melalui Portal Website yang dapat mengidentifikasi user yang sedang menggunakan mobile apps.
                            </li>
                          </ol>
                      </div>
                      <div id="two">
                          <h4>2. Pengelolaan Data</h4>
                          <ol>
                            <li>
                              Virtusee menyimpan dan mengelola berbagai macam jenis informasi customer termasuk namun tidak terbatas pada data karyawan dan data absensi karyawan. Data customer tidak disalahgunakan oleh Virtusee, kecuali ditentukan oleh customer layanan Virtusee. Virtusee mengelola data yang customer berikan untuk keperluan:
                              <ol>
                                <li>Mengelola data laporan kunjungan</li>
                                <li>Mengelola kuisioner berdasarkan permintaan customer</li>
                                <li>Mengelola data lokasi</li>
                              </ol>
                            </li>
                            <li>
                              Virtusee menjamin tidak ada penjualan, pengalihan, distribusi atau meminjamkan informasi/data pribadi Customer kepada pihak ketiga lain, tanpa terdapat izin dari Customer. Kecuali Apabila Virtusee berkewajiban mengungkapkan dan/atau berbagi data pribadi Customer dalam upaya mematuhi kewajiban hukum yang berlaku.
                            </li>
                          </ol>
                      </div>
                      <div id="three">
                          <h4>3. Akses Situs</h4>
                          <p>
                            Virtusee mengumpulkan Statistik Website (log file) dengan tujuan untuk mengukur kinerja, keamanan dan perbaikan situs Virtusee.
                          </p>
                      </div>

                      <div id="four">
                          <h4>4. Portal Web</h4>
                          <ol> 
                            <li>
                              Portal Website Virtusee dilindungi oleh Hak Kekayaan Intelektual termasuk namun tidak terbatas pada Hak Cipta dan Merek Dagang baik yang terdaftar maupun tidak.
                            </li>
                            <li>
                              Tindakan hukum akan dilakukan apabila ditemui tindakan percobaan, baik yang disengaja atau tidak disengaja, untuk mengubah atau merusak Portal Website Virtusee dan/atau perangkat server yang termuat di dalamnya, tanpa izin khusus yang diberikan oleh pengelola resmi dan sah Virtusee.
                            </li>
                          </ol>
                      </div>

                      <div id="five">
                          <h4>5. Mobile Apps</h4>
                          <ol>
                            <li>
                              Ketika user menggunakan mobile apps melalui telepon genggam, Virtusee akan melacak dan mengumpulkan informasi mengenai lokasi user secara real-time.
                            </li>
                            <li>
                              Virtusee menggunakan informasi ini untuk memasukkan data tersebut pada sistem yang dimiliki.
                            </li>
                            <li>
                              User dapat mematikan informasi pelacak pada perangkatnya ketika sedang tidak menggunakan mobile apps.
                            </li>
                            <li>
                              Perangkat bergerak user akan memberitahukan user untuk menhidupkan informasi pelacak ketika user ingin melalukan kegiatan absensi pada mobile apps Virtusee.
                            </li>
                          </ol>
                      </div>

                      <div id="six">
                          <h4>6. Penggunaan Cookies </h4>
                          <p>
                            Cookies adalah teknologi standar yang digunakan untuk menyimpan potongan-potongan kecil informasi pada hard drive Customer untuk browser Customer. Kebanyakan web browser secara otomatis menerima cookies, kecuali jika Customer telah mengkonfigurasi browser untuk tidak menerima mereka.
                          </p>
                      </div>

                      <div id="sevven">
                          <h4>7. Ketentuan Lain-lain</h4>
                          <ol>
                            <li>
                              Sewaktu-waktu, Vitusee dapat merevisi Kebijakan Privasi ini untuk mencerminkan perubahan dalam hukum, pengumpulan dan praktik penggunaan Data Pribadi, fitur portal website dan mobile apps, atau kemajuan dalam teknologi pada Virtusee. Jika Virtusee membuat revisi yang mengubah cara Virtusee mengumpulkan atau menggunakan Data Pribadi Customer, perubahan tersebut akan dimuat di dalam tautan Kebijakan Privasi ini dan tanggal berlaku akan dicatat pada permulaan Kebijakan Privasi ini. Oleh karena itu, Customer harus meninjau Kebijakan Privasi ini secara berkala sehingga Customer selalu mendapatkan informasi terkini akan kebijakan terbaru yang sedang berkaku. Berlakunya sebuah revisi perubahan kebijakan akan berlaku secara aktif sejak tanggal pengumuman yang dibuat dalam portal website Virtusee.
                            </li>
                            <li>
                              Apabila ada perbedaan interpretasi bahasa dalam kebijakan privasi ini, maka syarat dan ketentuan versi bahasan Indonesia yang akan berlaku.
                            </li>
                            <li>
                              Dengan menggunakan Virtusee, Customer mengakui bahwa Customer telah membaca, memahami, dan menyetujui Kebijakan Privasi ini.
                            </li>
                            <li>
                              Mengenai komunikasi terhadap kebijakan privasi ini silahkan menghubungi Virtusee pada:
                              <ol>
                                <li>
                                  Email : info@virtusee.com
                                </li>
                                <li>
                                  Telepon : (031) 8700688
                                </li>
                                <li>
                                  Kantor Virtusee : JL. Penjaringan Sari, YKP Pandugo 2 Blok P No. 25, Penjaringan Sari, Kec. Rungkut, Kota Surabaya, Jawa Timur.
                                </li>
                              </ol>
                            </li>
                          </ol>
                      </div>
                    
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

@endsection