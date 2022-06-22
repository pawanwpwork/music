@extends('layouts.app')

@section('content')
<div class="sitecontent__outer">
    <div class="container">
        <div class="sitecontent">
            <div class="cdstore__wrap">
                <div class="row cdstore__row">

                    <div class="cdstore__col cdstore__col-main col-lg-12">
                        <div class="box">
                            <div class="product__header">
                                <div class="row">
                                    <div class="product__header-col col-12">
                                        <h1 class="heading-page">CD Store</h1>
                                    </div>
                                    <div class="product__header-col product__header-col--sorting col-md-8">
                                        <div class="product__sorting-wrap">
                                            <form action="{{route('cd.store')}}" id="productSorting" class="productSorting">
                                                <div class="row">
                                                    <div class="formfield frmSearchBy col-md-6" id="frmSearchBy">
                                                        <input name="search" type="text" placeholder="Search" value="{{request('search')}}">
                                                        <button type="submit"><i class="fa fa-search"></i></button>
                                                    </div>
                                                    <div class="formfield frmOrderBy col-md-6" id="frmOrderBy">
                                                        <select name="orderby" class="orderby">
                                                            
                                                            <option value="default" {{request('orderby') == 'default' ? 'selected' : ''}}>Default</option>
                                                            
                                                            <option value="name_asc" {{request('orderby') == 'name_asc' ? 'selected' : ''}}>Name (A - Z)</option>

                                                            <option value="name_desc" {{request('orderby') == 'name_desc' ? 'selected' : ''}}>Name (Z - A)</option>
                                                            
                                                            <option value="price_low" {{request('orderby') == 'price_low' ? 'selected' : ''}}>Price (Low &gt; High)</option>

                                                            <option value="price_high" {{request('orderby') == 'price_high' ? 'selected' : ''}}>Price (High &gt; Low)</option>

                                                          <!--   <option value="rating_highest" {{request('orderby') == 'rating_highest' ? 'selected' : ''}}>Rating (Highest)</option>

                                                            <option value="rating_lowest" {{request('orderby') == 'rating_lowest' ? 'selected' : ''}}>Rating (Lowest)</option> -->

                                                            <option value="model_asc" {{request('orderby') == 'model_asc' ? 'selected' : ''}}>Model (A - Z)</option>

                                                            <option value="model_desc" {{request('orderby') == 'model_desc' ? 'selected' : ''}}>Model (Z - A)</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="product__header-col product__header-col--result col-md-4">
                                        <p class="product__resultcount">Showing all {{isset($cdProductCount) ? count($cdProductCount) : 0}} results</p>
                                    </div>

                                </div>
                            </div>

                            <div class="product__wrap">
                                <div class="row product__row">
                                    @if(isset($cdProductCount) && count($cdProductCount) > 0)
                                    @foreach($cdProducts as $cdProduct)
                                        <div class="product__col col-lg-4 col-md-6">
                                            <div class="product__box">
                                                <div class="product__thumbnail square">
                                                    <div class="product-notice product-notice--slanted">Sale!</div>
                                                    <img class="product-img" src="{{route('admin.product.storage',$cdProduct->id)}}"
                                                        alt="">
                                                    <div class="product-overlay">
                                                        <a href="{{ route('cd.single-page',$cdProduct->alias) }}" class="product-link product-link--view"><i class="fa fa-folder-open"></i>
                                                            View</a>
                                                       <form action="{{route('frontend.cd.addtocart',encrypt($cdProduct->id))}}" class="preview-cart-form" method="POST">
                                                            @csrf()
                                                           
                                                            <input type="hidden" value="1" name="quantity">
                                                           
                                                            <div class="preview-cart-button">
                                                                <button type="submit" class="product-link product-link--cart" style="color:#FFF;cursor: pointer;padding:"><i class="fa fa-cart-plus"></i>Add to Cart</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="product__cont">
                                                    <div class="product-title"><a href="{{ route('cd.single-page',$cdProduct->alias) }}">{{ $cdProduct->name ?? '' }}</a></div>
                                                    <div class="product-price">${{ $cdProduct->price }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @else
                                        <p>No CD Product!</p>
                                    @endif
                                    
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                     @if( $totalEvent > $perPage )
                                        <nav aria-label="Page navigation" style="background: #000;padding: 30px;">
                                          <ul class="pagination">
                                            @if( $maxNumPage > 1 )
                                            <li>
                                              <a href="{{\Request::url()}}?page={{isset($page) ? ( $page-1 ) : 1}}" aria-label="Previous">
                                                <span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                                              </a>
                                            </li>
                                            @endif
                                            @for( $i=1;$i<=$maxNumPage;$i++ )
                                            @if( $page == 0 )
                                            @php 
                                                $page = 1;
                                            @endphp
                                            @else
                                                @php 
                                                    $page = $page;
                                                @endphp
                                            @endif
                                            <li @if($page == $i) class="active" @endif><a href="{{\Request::url()}}?page={{$i}}">{{$i}}</a></li>
                                            @endfor
                                            @if($page != $maxNumPage)
                                            <li>
                                              <a href="{{\Request::url()}}?page={{isset($page) ? ( $page+1 ) : 1}}" aria-label="Next">
                                                <span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                              </a>
                                            </li>
                                            @endif
                                          </ul>
                                        </nav>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $("#productSorting select[name=orderby]").change(function(){
        $("#productSorting").submit();  
    });
</script>
@endsection