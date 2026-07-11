@auth
              @if (!auth()->user()->hasVerifiedEmail())
                  <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                      @csrf
                      <button type="submit" class="btn-kembali relative text-sm font-thick text-purple-600 transition-colors duration-300 ease">
                        Verifikasi Email
                        <span class="btn-kembali-after absolute left-1/2 bottom-[-4px] w-0 h-[1px] bg-orange-500 transition-all duration-300 ease-out"></span>
                      </button>
                  </form>
              @endif
          @endauth
          
          <style>
            :root {
              --amikom-purple: #7e3af2;
              --amikom-orange: #ff5a1f;
            }
          
            .btn-kembali {
              color: var(--amikom-purple);
            }
          
            .btn-kembali:hover {
              color: var(--amikom-orange);
            }
          
            .btn-kembali:hover .btn-kembali-after {
              width: 100%;
              left: 0;
            }
          </style>