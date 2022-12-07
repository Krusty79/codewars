
// A simple JavaScript program to implement Game of Life

// driver program

// Function to print next generation
function nextGeneration(grid,generations=1){
	let M = grid.length;
	let N =grid[0].length;
	let future = new Array(M);
	
	for(var i = 0; i < M; i++){
		future[i] = new Array(N).fill(0);
	}
	// Loop through every cell
	generation = 1;
	while(generation <= generations){
		console.log('generation:',generation);
		
		for(let l=0;l<M;l++){
			
			for(let m=0;m<N;m++){
				// finding no Of Neighbours that are alive
				let aliveNeighbours = 0
				for(let i = -1; i < 2; i++)
				{
					for(let j = -1; j < 2; j++)
					{
						if ((l + i >= 0 && l + i < M) && (m + j >= 0 && m + j < N))
							aliveNeighbours += grid[l + i][m + j]
					}
				}
				// The cell needs to be subtracted from
				// its neighbours as it was counted before
				aliveNeighbours -= grid[l][m]

				// Implementing the Rules of Life

				// Cell is lonely and dies
				if ((grid[l][m] == 1) && (aliveNeighbours < 2))
					future[l][m] = 0

				// Cell dies due to over population
				else if ((grid[l][m] == 1) && (aliveNeighbours > 3))
					future[l][m] = 0

				// A new cell is born
				else if ((grid[l][m] == 0) && (aliveNeighbours == 3))
					future[l][m] = 1

				// Remains the same
				else
					future[l][m] = grid[l][m]
			}
			
		}
		future.forEach(element => {
			console.log(element.toString());
		});
		grid = future
		generation++;	
	}
}

// Initializing the grid.
/*
let grid = [ [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ],
	[ 0, 0, 0, 1, 1, 0, 0, 0, 0, 0 ],
	[ 0, 0, 0, 0, 1, 0, 0, 0, 0, 0 ],
	[ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ],
	[ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ],
	[ 0, 0, 0, 1, 1, 0, 0, 0, 0, 0 ],
	[ 0, 0, 1, 1, 0, 0, 0, 0, 0, 0 ],
	[ 0, 0, 0, 0, 0, 1, 0, 0, 0, 0 ],
	[ 0, 0, 0, 0, 1, 0, 0, 0, 0, 0 ],
	[ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ]
]
*/
let grid = [
	[1,0,0],
	[0,1,1],
	[1,1,0]
];

// Displaying the grid
console.log("Original Generation\n");

grid.forEach(element => {
	console.log(element.toString());
});
console.log(grid.length,'/',grid[0].length);
nextGeneration(grid,4)
