@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-info text-uppercase">
                            Ticket List
                            <a href="">
                                <button type="button" class="btn btn-success btn-sm float-right">
                                    <i class="fa fa-plus">
                                        New Ticket
                                    </i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-lg-8">
                                    <input type="text" name="search" class="form-control" placeholder="SEARCH">
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-primary btn-sm float-left">
                                        <i class="fa fa-search">SEARCH</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="form-group row">
                            <div class="card">

                            </div>
                            <table class="table table-bordered table-responsive-lg">
                                <tr>
                                    <th>ID</th>
                                    <th>Reference</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>View</th>
                                </tr>
                                @if (isset($tickets))
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td>{{ $ticket->reference }}</td>
                                            <td>
                                                @if ($ticket->agent_viewed_at != null)
                                                    <span class="badge badge-success">Reviewed</span>
                                                @else
                                                    <span class="badge badge-primary">Pending</span>
                                                @endif
                                            </td>
                                            <td>{{ $ticket->created_at }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                        data-target="#exampleModal" data-whatever="@getbootstrap">View
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">View Ticket</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group row">
                                                            <label for="customer_name"
                                                                   class="col-md-4 col-form-label text-md-right">Customer
                                                                Name</label>
                                                            <div class="col-md-6">
                                                                <input id="customer_name" type="text"
                                                                       class="form-control"
                                                                       name="customer_name"
                                                                       value="{{ $ticket->customer_name }}"
                                                                       disabled>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="description"
                                                                   class="col-md-4 col-form-label text-md-right">Description</label>
                                                            <div class="col-md-6">
                                                        <textarea id="description" type="text"
                                                                  class="form-control"
                                                                  name="description"
                                                                  disabled>{{ $ticket->description }}
                                                        </textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="email"
                                                                   class="col-md-4 col-form-label text-md-right">Email</label>
                                                            <div class="col-md-6">
                                                                <input id="email" type="email"
                                                                       class="form-control"
                                                                       name="email" value="{{ $ticket->email }}"
                                                                       disabled>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="phone"
                                                                   class="col-md-4 col-form-label text-md-right">Phone</label>
                                                            <div class="col-md-6">
                                                                <input id="phone" type="text"
                                                                       class="form-control"
                                                                       name="phone" value="{{ $ticket->phone }}"
                                                                       disabled>
                                                            </div>
                                                        </div>

                                                        @if ($ticket->response !=null)
                                                            <div class="form-group row">
                                                                <label for="response"
                                                                       class="col-md-4 col-form-label text-md-right">Response</label>
                                                                <div class="col-md-6">
                                                        <textarea id="response" type="text"
                                                                  class="form-control"
                                                                  name="response"
                                                                  disabled>{{ $ticket->response }}
                                                        </textarea>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
