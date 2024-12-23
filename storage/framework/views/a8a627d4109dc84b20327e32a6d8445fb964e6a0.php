

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row" style="margin-top: 10px;">
        
        <div class="col-md-2">
            <div class="list-group">
                <a href="<?php echo e(route('showAdp')); ?>" 
                    class="list-group-item list-group-item-action <?php echo e(!request('species') ? 'active' : ''); ?>">
                    All Categories
                </a>
                <a href="<?php echo e(route('showAdp', ['species' => 'cat'])); ?>" 
                    class="list-group-item list-group-item-action <?php echo e(request('species') === 'cat' ? 'active' : ''); ?>">
                    Cat
                </a>
                <a href="<?php echo e(route('showAdp', ['species' => 'dog'])); ?>" 
                    class="list-group-item list-group-item-action <?php echo e(request('species') === 'dog' ? 'active' : ''); ?>">
                    Dog
                </a>
                <a href="<?php echo e(route('showAdp', ['species' => 'other'])); ?>" 
                    class="list-group-item list-group-item-action <?php echo e(request('species') === 'other' ? 'active' : ''); ?>">
                    Other
                </a>
            </div>
            <br>
        </div>

        <div class="col-md-1"></div>

        
        <div class="col-md-8">
            <div class="card border-0">
                <h5 class="title1 card-title">Pets for Adoption</h5>
                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $pets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="pet-title"><?php echo e($pet->name); ?></h5>
                                    <?php if($pet->photos && count($pet->photos) > 0): ?>
                                        <img src="<?php echo e(Storage::url($pet->photos[0])); ?>" 
                                            class="pet-img card-img-bottom" 
                                            alt="<?php echo e($pet->name); ?>"
                                            style="height: 200px; object-fit: cover;">
                                    <?php endif; ?>
                                    <div class="row mt-3">
                                        <div class="col-7">
                                            <div class="card-heading">
                                                <p class="mb-1"><strong>Age:</strong> <?php echo e($pet->age); ?> years</p>
                                                <p class="mb-1"><strong>Species:</strong> <?php echo e(ucfirst($pet->species)); ?></p>
                                                <p class="mb-1"><strong>Breed:</strong> <?php echo e(ucfirst($pet->breed)); ?></p>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end">
                                            <a href="<?php echo e(route('pets.show', $pet->id)); ?>" 
                                                class="btn btn-danger btn-sm">
                                                See Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12">
                            <div class="alert alert-info">
                                No pets available for adoption at the moment.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="d-flex justify-content-end">
                    <?php echo e($pets->links()); ?>

                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CourseTools\Laragon\laragon\www\BTPR2\resources\views/common/showAdpPet.blade.php ENDPATH**/ ?>