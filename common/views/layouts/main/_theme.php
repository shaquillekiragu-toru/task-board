<?php
$themes = [
	'light',
	'dark',
	'cupcake',
	'bumblebee',
	'emerald',
	'corporate',
	'synthwave',
	'retro',
	'cyberpunk',
	'valentine',
	'halloween',
	'garden',
	'forest',
	'aqua',
	'lofi',
	'pastel',
	'fantasy',
	'wireframe',
	'black',
	'luxury',
	'dracula',
	'cmyk',
	'autumn',
	'business',
	'acid',
	'lemonade',
	'night',
	'coffee',
	'winter',
];
sort($themes);
?>

<div title="Change Theme" class="dropdown dropdown-end ">
	<!--<div tabindex="0" class="btn gap-1 normal-case btn-ghost">
		<span class="hidden md:inline">Theme</span>
		<svg width="12px" height="12px" class="ml-1 hidden h-3 w-3 fill-current opacity-60 sm:inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2048 2048">
			<path d="M1799 349l242 241-1017 1017L7 590l242-241 775 775 775-775z"></path>
		</svg>
	</div>-->
	<div class="dropdown-content bg-base-200 text-base-content rounded-t-box rounded-b-box top-px max-h-96 h-[70vh] w-52 overflow-y-auto shadow-2xl mt-16">
		<div class="grid grid-cols-1 gap-3 p-3" tabindex="0">
			<?php foreach ($themes as $theme) { ?>
				<div class="outline-base-content overflow-hidden rounded-lg" data-set-theme="<?= $theme ?>">
					<div data-theme="<?= $theme ?>" class="bg-base-100 text-base-content w-full cursor-pointer font-sans">
						<div class="grid grid-cols-5 grid-rows-3">
							<div class="col-span-5 row-span-3 row-start-1 flex gap-1 py-3 px-4">
								<div class="flex-grow text-sm font-bold"><?= $theme ?></div>
								<div class="flex flex-shrink-0 flex-wrap gap-1">
									<div class="bg-primary w-2 rounded"></div>
									<div class="bg-secondary w-2 rounded"></div>
									<div class="bg-accent w-2 rounded"></div>
									<div class="bg-neutral w-2 rounded"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			<a class="outline-base-content overflow-hidden rounded-lg" href="https://daisyui.com/theme-generator/">
				<div class="hover:bg-neutral hover:text-neutral-content w-full cursor-pointer font-sans">
					<div class="flex gap-2 p-3"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current" viewBox="0 0 512 512">
							<path d="M96,208H48a16,16,0,0,1,0-32H96a16,16,0,0,1,0,32Z"></path>
							<line x1="90.25" y1="90.25" x2="124.19" y2="124.19"></line>
							<path d="M124.19,140.19a15.91,15.91,0,0,1-11.31-4.69L78.93,101.56a16,16,0,0,1,22.63-22.63l33.94,33.95a16,16,0,0,1-11.31,27.31Z"></path>
							<path d="M192,112a16,16,0,0,1-16-16V48a16,16,0,0,1,32,0V96A16,16,0,0,1,192,112Z"></path>
							<line x1="293.89" y1="90.25" x2="259.95" y2="124.19"></line>
							<path d="M260,140.19a16,16,0,0,1-11.31-27.31l33.94-33.95a16,16,0,0,1,22.63,22.63L271.27,135.5A15.94,15.94,0,0,1,260,140.19Z"></path>
							<line x1="124.19" y1="259.95" x2="90.25" y2="293.89"></line>
							<path d="M90.25,309.89a16,16,0,0,1-11.32-27.31l33.95-33.94a16,16,0,0,1,22.62,22.63l-33.94,33.94A16,16,0,0,1,90.25,309.89Z"></path>
							<path d="M219,151.83a26,26,0,0,0-36.77,0l-30.43,30.43a26,26,0,0,0,0,36.77L208.76,276a4,4,0,0,0,5.66,0L276,214.42a4,4,0,0,0,0-5.66Z"></path>
							<path d="M472.31,405.11,304.24,237a4,4,0,0,0-5.66,0L237,298.58a4,4,0,0,0,0,5.66L405.12,472.31a26,26,0,0,0,36.76,0l30.43-30.43h0A26,26,0,0,0,472.31,405.11Z"></path>
						</svg>
						<div class="flex-grow text-sm font-bold">Make your theme!</div>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>