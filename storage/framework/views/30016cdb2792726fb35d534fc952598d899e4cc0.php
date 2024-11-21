

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <h2>Pets Pending Verification</h2>
        </div>
    </div>

    <?php if($unverifiedPets->isEmpty()): ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            No pets pending verification at the moment.
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php $__currentLoopData = $unverifiedPets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col">
                <div class="card h-100">
                    <?php if($pet->photos && count($pet->photos) > 0): ?>
                        <img src="<?php echo e(Storage::url($pet->photos[0])); ?>" 
                            class="card-img-top" alt="Pet Photo"
                            style="height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($pet->name); ?></h5>
                        <p class="card-text">
                            <small class="text-muted">Added by: <?php echo e($pet->user->name); ?></small>
                        </p>
                        <ul class="list-unstyled">
                            <li><strong>Species:</strong> <?php echo e(ucfirst($pet->species)); ?></li>
                            <li><strong>Breed:</strong> <?php echo e(ucfirst($pet->breed)); ?></li>
                            <li><strong>Age:</strong> <?php echo e($pet->age); ?></li>
                            <li><strong>Gender:</strong> <?php echo e(ucfirst($pet->gender)); ?></li>
                            <li><strong>Health Status:</strong> 
                                <?php $__currentLoopData = $pet->healthStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge bg-info"><?php echo e($status); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </li>
                        </ul>
                        <p class="card-text"><?php echo e(Str::limit($pet->description, 100)); ?></p>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-primary btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#petModal<?php echo e($pet->id); ?>">
                                View Details
                            </button>
                            <div>
                                <form action="<?php echo e(route('pets.verify', $pet->id)); ?>" 
                                    method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check me-1"></i>Verify
                                    </button>
                                </form>
                                <form action="<?php echo e(route('pets.reject', $pet->id)); ?>" 
                                    method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times me-1"></i>Reject
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="petModal<?php echo e($pet->id); ?>" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e($pet->name); ?> - Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php if($pet->photos && count($pet->photos) > 0): ?>
                                        <div id="petCarousel<?php echo e($pet->id); ?>" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php $__currentLoopData = $pet->photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                                                        <img src="<?php echo e(Storage::url($photo)); ?>" 
                                                            class="d-block w-100" alt="Pet Photo">
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                            <?php if(count($pet->photos) > 1): ?>
                                                <button class="carousel-control-prev" type="button" 
                                                    data-bs-target="#petCarousel<?php echo e($pet->id); ?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon"></span>
                                                </button>
                                                <button class="carousel-control-next" type="button" 
                                                    data-bs-target="#petCarousel<?php echo e($pet->id); ?>" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon"></span>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($pet->videos): ?>
                                        <?php $__currentLoopData = $pet->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <video controls class="w-100 mt-2">
                                                <source src="<?php echo e(Storage::url($video)); ?>" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <h6>Basic Information</h6>
                                    <ul class="list-unstyled">
                                        <li><strong>Species:</strong> <?php echo e(ucfirst($pet->species)); ?></li>
                                        <li><strong>Breed:</strong> <?php echo e(ucfirst($pet->breed)); ?></li>
                                        <li><strong>Age:</strong> <?php echo e($pet->age); ?></li>
                                        <li><strong>Gender:</strong> <?php echo e(ucfirst($pet->gender)); ?></li>
                                        <li><strong>Color:</strong> <?php echo e(ucfirst($pet->color)); ?></li>
                                        <li><strong>Size:</strong> <?php echo e(ucfirst($pet->size)); ?></li>
                                        <li><strong>Vaccinated:</strong> 
                                            <span class="badge <?php echo e($pet->vaccinated ? 'bg-success' : 'bg-warning'); ?>">
                                                <?php echo e($pet->vaccinated ? 'Yes' : 'No'); ?>

                                            </span>
                                        </li>
                                    </ul>
                                    <h6>Health Status</h6>
                                    <div class="mb-3">
                                        <?php $__currentLoopData = $pet->healthStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge bg-info"><?php echo e($status); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <h6>Description</h6>
                                    <p><?php echo e($pet->description); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\CourseTools\Laragon\laragon\www\BTPR2\resources\views/admin/petInfoVerification.blade.php ENDPATH**/ ?>