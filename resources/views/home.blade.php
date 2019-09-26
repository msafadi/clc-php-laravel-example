@extends('layouts.layout')

@section('title', 'Homepage')

@section('content')
        <section>
            <div id="slider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slider" data-slide-to="0" class="active"></li>
                    <li data-target="#slider" data-slide-to="1"></li>
                    <li data-target="#slider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/assets/images/slider-image.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="h2">Welcome to our web site</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="/assets/images/slider-image.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="h2">Welcome to our web site</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="/assets/images/slider-image.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="h2">Welcome to our web site</h3>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since.</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>
        <section class="mt-5 services">
            <div class="container">
                <h2 class="text-uppercase text-center mb-4">Lorem Ipsum is simply dummy of the printing.</h2>
                <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took
                    a galley of type and scrambled it to make atype specimen book.
                    It has survived not only five centuries.
                    but also the leap into electronic typesetting, remaining essentially unchanged.</p>

                <div class="row mt-5">
                    <div class="col-md-4 text-center service ">
                        <i class="fas fa-desktop large-icon"></i>
                        <h3 class="py-3 h5">Lorem Ipsum is simply</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting of the industry. Lorem
                            Ipsum has been
                            the and scrambled it.
                            atype specimen
                        </p>
                    </div>
                    <div class="col-md-4 text-center service active">
                        <i class="fas fa-edit large-icon"></i>
                        <h3 class="py-3 h5">Lorem Ipsum is simply</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting of the industry. Lorem
                            Ipsum has been
                            the and scrambled it.
                            atype specimen
                        </p>
                    </div>
                    <div class="col-md-4 text-center service ">
                        <i class="far fa-image large-icon"></i>
                        <h3 class="py-3 h5">Lorem Ipsum is simply</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting of the industry. Lorem
                            Ipsum has been
                            the and scrambled it.
                            atype specimen
                        </p>
                    </div>
                </div>
            </div>
            <div class="services-items py-5">
                <div class="container">
                    <div class="row">
                        
                            @forelse($data as $key => $post)
                            <div class="col-md-4 service-item">
                                <div class="item-inner">
                                    <div class="image-fit">
                                        <img src="{{ asset($post['image']) }}">
                                    </div>
                                    <div class="p-3">
                                        <h4 class="my-3"><a href="/posts/{{ $key }}">{{ $post['title'] }}</a></h4>
                                        <p>{{ $post['content'] }}</p>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p>No posts</p>
                            @endforelse
                        
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('footer')
    <p class="bg-light p-5">&copy; 2019. All rights reserved.</p>
@endsection