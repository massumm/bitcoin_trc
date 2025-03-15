@extends('layouts.master')
@section('content')

 <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                        <div class="card-body">
                            <div>
                                <h3>Dashboard</h3>
                            </div>
                        </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">

                    <div class="card">
                        <div class="card-header">
                          <h4>Medicine Order Statistics</h4>
                        </div>
                        <div class="card-body">
                          <div class="row text-center">
                            <div class="col">
                              <h3>00</h3>
                              <p>Pending</p>
                            </div>
                            <div class="col">
                              <h3>00</h3>
                              <p>Process</p>
                            </div>
                            <div class="col">
                              <h3>00</h3>
                              <p>On Route</p>
                            </div>
                            <div class="col">
                              <h3>00</h3>
                              <p>Cancel</p>
                            </div>
                            <div class="col">
                              <h3>00</h3>
                              <p>Completed</p>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
              </div>
 </div>

@endsection
