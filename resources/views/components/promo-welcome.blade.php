<div class="promo-welcome">
    <!-- text -->
    <div class="max-w-screen-lg flex flex-col sm:flex-row relative mx-auto items-center py-8">
        <div class="w-full flex flex-col sm:flex-row justify-center text-left items-center">
            <!-- <h2>{{__('La felicidad está en un trozo de tarta')}}</h2> -->
            <div class="btns-port-web flex justify-center items-center w-1/2">
                <div class="h-64 w-64 rounded-full absolute">
                    <img src="{{ asset('storage/img/piece-of-brownie-cake-filled.jpeg') }}" class="max-h-[300px] w-auto rounded-full " alt="brownie" />
                </div>
                <div class="text-rotate">
                    <svg viewBox="0 0 100 100">
                        <path d="M 0,50 a 50,50 0 1,1 0,1 z" id="circle" />
                        <text>
                            <textPath xlink:href="#circle">
                                La felicidad está en un trozo de tarta
                            </textPath>
                        </text>
                    </svg>
                </div>
            </div>
            <div class="w-1/2">
                <p>En nuestra pastelería, las tartas guardan secretos dulces que despiertan sonrisas mientras exploras el mágico universo de lo hecho a mano con cariño.</p>
            </div>
        </div>
        <!-- text -->
        <!-- image -->
        <!-- <div class="w-auto flex justify-end sm:justify-center pb-8">
            <img src="{{ asset('storage/img/torta.png') }}" class="max-h-[300px] w-auto" alt="brownie" />
        </div> -->
        <!-- image -->

    </div>
</div>

<style>
    .btns-port-web .text-rotate svg {
		overflow: visible;
		animation: circular-text-rotate 5s linear paused infinite;
		width: 300px;
        font-family: 'Mount-Hills';
    	letter-spacing: 0.05rem;
		font-weight:bold;
	}
	.btns-port-web .text-rotate svg:hover {
		animation-play-state: running;
	}
	.btns-port-web .text-rotate path {
		fill: none;
	}
	.btns-port-web .text-rotate text {
		fill:#6C4852;
	}
	@keyframes circular-text-rotate {
		to {
		transform: rotate(1turn);
		}
	}
</style>