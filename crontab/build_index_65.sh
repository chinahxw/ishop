#!/bin/sh
list="252 253 254 255 257 258 259 260 261 262 263 264 265 266 267 269 270 273 274 275 278 279 280 281 282 283 284 285 286 287 288 289 290 293 294 295 296 297 299 300 301 302 303 304 305 306 307 308 309 310 311 312 313 314 315 316 317 318 319 320 322 323 324 326 327 328 329 330 332 333 334 335 336 338 340 341 342 343 344 345 346 347 348 349 350 351 352 354 363 364 365 366 371 372 373 374 375 377 378 379 380 381 385 387 388 389 390 391 392 393 395 396 397 398 399 401 402"
if [ "$#" -gt "0" ];then
    list=$@
fi

for i in $list;
do
/usr/bin/php /data/www/crontab/index.php boss_style build update $i;
sleep 10s;
done